<?php
// WebExplorer Generic File Transfer Plugin
// This plugin requires Microsoft Data Access Components (MDAC) 2.5+ 
// to be installed on the server. See http://www.microsoft.com/data

// Standard Class for File Transfer Plugin
class pluginFileTransfer
{
  var $path;
  var $uploadedFileName,$uploadedFileSize;
  var $contentType;

// Create objects required by the plugin
  function pluginFileTransfer()
  {
    extract($GLOBALS);

//FSO is already available so the folowing line is commented out
//Set FSO = server.CreateObject ("Scripting.FileSystemObject")
    // $stream is of type "ADODB.Stream"
    return $function_ret;
  } 

// Destroy objects
  function Class_Terminate()
  {
    extract($GLOBALS);

//Set FSO = Nothing
    $stream=null;

    return $function_ret;
  } 

// Upload the posted file
// Return values: 0 - success, 1 - no file sent, 2 - path not found, 3 - write error
  function Upload()
  {
    extract($GLOBALS);


    $stream->Type=1;
    $stream->Open;

    ParsePost();

    if ($uploadedFileSize<=0)
    {

      $function_ret=1;
    }
      else
    if (!$FSO->FolderExists($path))
    {

      $function_ret=2;
    }
      else
    {



      $stream->SaveToFile ; $FSO->BuildPath($path   ,   $uploadedFileName);

      if (0 /* not sure how to convert err.Number */ !=0)
      {

        $function_ret=3;
      }
        else
      {

        $function_ret=0;
      } 

    } 


    $stream->Close;
    return $function_ret;
  } 

// Download the file with the given name at current path
// Return values: 0 - success, 1 - file not found, 2 - read error
  function Download($fileName)
  {
    extract($GLOBALS);

    $filePath=$FSO->BuildPath($path  ,   $fileName);

    if (!$FSO->FileExists($filePath))
    {

      $function_ret=1;
    }
      else
    {

      $stream->Type=1;
      $stream->Open;


      $stream->LoadFromFile($filePath);

      if (0 /* not sure how to convert err.Number */ !=0)
      {

        $function_ret=2;
      }
        else
      {

        header("Content-Disposition".": "."attachment;filename=".$fileName);
        header("Content-Length".": ".$stream->Size);
        // Unknown response object on line 74
           $lang="UTF-8";// changed
        header("Content-type: "."application/octet-stream");         print $stream->Read;
        $function_ret=0;
      } 


      $stream->Close;
    } 

    return $function_ret;
  } 

// --- Internal variables and functions specific to this plugin only (non standard) ---

  var $stream;

// Parses the posted data to extract file data and info
  function ParsePost()
  {
    extract($GLOBALS);



    //$biData=();// unsupported: $;// unsupported: $;  changed

    $nPosBegin=1;
    $nPosEnd=(strpos($biData,CByteString(chr(13)),$nPosBegin) ? strpos($biData,CByteString(chr(13)),$nPosBegin)+1 : 0);
    if (($nPosEnd-$nPosBegin)<=0)
    {
      return $function_ret;

    } 

    $vDataBounds=substr($biData,$nPosBegin-1,$nPosEnd-$nPosBegin);
    $nDataBoundPos=(strpos($biData,$vDataBounds,1) ? strpos($biData,$vDataBounds,1)+1 : 0);
    $nPos=(strpos($biData,CByteString("Content-Disposition"),$nDataBoundPos) ? strpos($biData,CByteString("Content-Disposition"),$nDataBoundPos)+1 : 0);$nPos=(strpos($biData,CByteString("name="),$nPos) ? strpos($biData,CByteString("name="),$nPos)+1 : 0);$nPosBegin=$nPos+6;
    $nPosEnd=(strpos($biData,CByteString(chr(34)),$nPosBegin) ? strpos($biData,CByteString(chr(34)),$nPosBegin)+1 : 0);$sInputName=CWideString(substr($biData,$nPosBegin-1,$nPosEnd-$nPosBegin));
    $nPosFile=(strpos($biData,CByteString("filename="),$nDataBoundPos) ? strpos($biData,CByteString("filename="),$nDataBoundPos)+1 : 0);$nPosBound=(strpos($biData,$vDataBounds,$nPosEnd) ? strpos($biData,$vDataBounds,$nPosEnd)+1 : 0);
    if ($nPosFile!=0 && $nPosFile<$nPosBound)
    {

      $nPosBegin=$nPosFile+10;
      $nPosEnd=(strpos($biData,CByteString(chr(34)),$nPosBegin) ? strpos($biData,CByteString(chr(34)),$nPosBegin)+1 : 0);$uploadedFileName=CWideString(substr($biData,$nPosBegin-1,$nPosEnd-$nPosBegin));
      $uploadedFileName=substr($uploadedFileName,strlen($uploadedFileName)-(strlen($uploadedFileName)-(strrpos($uploadedFileName,"\\") ? strrpos($uploadedFileName,"\\")+1 : 0)));

      $nPos=(strpos($biData,CByteString("Content-Type:"),$nPosEnd) ? strpos($biData,CByteString("Content-Type:"),$nPosEnd)+1 : 0);$nPosBegin=$nPos+14;
      $nPosEnd=(strpos($biData,CByteString(chr(13)),$nPosBegin) ? strpos($biData,CByteString(chr(13)),$nPosBegin)+1 : 0);
      $contentType=CWideString(substr($biData,$nPosBegin-1,$nPosEnd-$nPosBegin));

      $nPosBegin=$nPosEnd+4;
      $nPosEnd=(strpos($biData,$vDataBounds,$nPosBegin) ? strpos($biData,$vDataBounds,$nPosBegin)+1 : 0);
      // $tmpStream is of type "ADODB.Stream"
      $tmpStream->Type=1;
      $tmpStream->Open;
      $tmpStream->Write;$biData;
      $tmpStream->Position=$nPosBegin-1;
      $tmpStream->CopyTostream  ;
      $nPosEnd-$nPosBegin;
      $tmpStream=null;


      $uploadedFileSize=$stream->Size;
    } 

    return $function_ret;
  } 

// String to byte string conversion
  function CByteString($sString)
  {
    extract($GLOBALS);

    for ($nIndex=1; $nIndex<=strlen($sString); $nIndex=$nIndex+1)
    {
      $function_ret=$CByteString.$ChrB[$AscB[substr($sString,$nIndex-1,1)]];

    }

    return $function_ret;
  } 

// Byte string to string conversion
  function CWideString($bsString)
  {
    extract($GLOBALS);

    $function_ret="";
    for ($nIndex=1; $nIndex<=strlen($bsString); $nIndex=$nIndex+1)
    {
      $function_ret=$CWideString.chr($AscB[substr($bsString,$nIndex-1,1)]);

    }

    return $function_ret;
  } 
} 
?>
