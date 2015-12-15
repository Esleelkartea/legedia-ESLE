<?php
/**
 * neofisMimeTypes class.
 *
 * @package    NeoCRM
 * @author     Roberto Martín Huelmo
 * @version    
 */
class NeofisMimeTypes
{
  protected $mimetypes = array();
  
  function __construct()
  {
    $mimetypes = array();
    $mimetypes["application/andrew-inset"] 			= "ez";
    $mimetypes["application/mac-binhex40"] 			= "hqx";
    $mimetypes["application/mac-compactpro"]		= "cpt";
    $mimetypes["application/msword"]				    = "doc";
    $mimetypes["application/octet-stream"] 			= "bin dms lha lzh exe class so dll";
    $mimetypes["application/oda"] 					    = "oda";
    $mimetypes["application/pdf"] 					    = "pdf";
    $mimetypes["application/postscript"] 			  = "ai eps ps";
    $mimetypes["application/smil"] 					    = "smi smil";
    $mimetypes["application/vnd.mif"] 				  = "mif";
    $mimetypes["application/vnd.ms-excel"] 			= "xls";
    $mimetypes["application/vnd.ms-powerpoint"] = "ppt";
    $mimetypes["application/vnd.wap.wbxml"] 		= "wbxml";
    $mimetypes["application/vnd.wap.wmlc"] 			= "wmlc";
    $mimetypes["application/vnd.wap.wmlscriptc"] 	= "wmlsc";
    $mimetypes["application/x-bcpio"] 				= "bcpio";
    $mimetypes["application/x-cdlink"] 				= "vcd";
    $mimetypes["application/x-chess-pgn"] 			= "pgn";
    $mimetypes["application/x-cpio"] 				= "cpio";
    $mimetypes["application/x-csh"] 				= "csh";
    $mimetypes["application/x-director"] 			= "dcr dir dxr";
    $mimetypes["application/x-dvi"] 				= "dvi";
    $mimetypes["application/x-futuresplash"] 		= "spl";
    $mimetypes["application/x-gtar"] 				= "gtar";
    $mimetypes["application/x-hdf"] 				= "hdf";
    $mimetypes["application/x-javascript"] 			= "js";
    $mimetypes["application/x-koan"] 				= "skp skd skt skm";
    $mimetypes["application/x-latex"] 				= "latex";
    $mimetypes["application/x-netcdf"] 				= "nc cdf";
    $mimetypes["application/x-sh"] 					= "sh";
    $mimetypes["application/x-shar"] 				= "shar";
    $mimetypes["application/x-shockwave-flash"] 	= "swf";
    $mimetypes["application/x-stuffit"] 			= "sit";
    $mimetypes["application/x-sv4cpio"] 			= "sv4cpio";
    $mimetypes["application/x-sv4crc"] 				= "sv4crc";
    $mimetypes["application/x-tar"] 				= "tar";
    $mimetypes["application/x-tcl"] 				= "tcl";
    $mimetypes["application/x-tex"] 				= "tex";
    $mimetypes["application/x-texinfo"] 			= "texinfo texi";
    $mimetypes["application/x-troff"] 				= "t tr roff";
    $mimetypes["application/x-troff-man"] 			= "man";
    $mimetypes["application/x-troff-me"] 			= "me";
    $mimetypes["application/x-troff-ms"] 			= "ms";
    $mimetypes["application/x-ustar"] 				= "ustar";
    $mimetypes["application/x-wais-source"] 		= "src";
    $mimetypes["application/zip"] 					= "zip";
    $mimetypes["audio/basic"] 						= "au snd";
    $mimetypes["audio/midi"] 						= "mid midi kar";
    $mimetypes["audio/mpeg"] 						= "mpga mp2 mp3";
    $mimetypes["audio/x-aiff"] 						= "aif aiff aifc";
    $mimetypes["audio/x-mpegurl"] 					= "m3u";
    $mimetypes["audio/x-pn-realaudio"] 				= "ram rm";
    $mimetypes["audio/x-pn-realaudio-plugin"] 		= "rpm";
    $mimetypes["audio/x-realaudio"] 				= "ra";	
    $mimetypes["audio/x-wav"] 						= "wav";
    $mimetypes["chemical/x-pdb"] 					= "pdb";
    $mimetypes["chemical/x-xyz"] 					= "xyz";
    $mimetypes["image/bmp"] 						= "bmp";
    $mimetypes["image/gif"] 						= "gif";
    $mimetypes["image/ief"] 						= "ief";
    $mimetypes["image/jpeg"] 						= "jpeg jpg jpe";
    $mimetypes["image/png"] 						= "png";
    $mimetypes["image/tiff"] 						= "tiff tif";
    $mimetypes["image/vnd.wap.wbmp"] 				= "wbmp";
    $mimetypes["image/x-cmu-raster"] 				= "ras";
    $mimetypes["image/x-portable-anymap"] 			= "pnm";
    $mimetypes["image/x-portable-bitmap"] 			= "pbm";
    $mimetypes["image/x-portable-graymap"] 			= "pgm";
    $mimetypes["image/x-portable-pixmap"] 			= "ppm";
    $mimetypes["image/x-rgb"] 						= "rgb";
    $mimetypes["image/x-xbitmap"] 					= "xbm";
    $mimetypes["image/x-xpixmap"] 					= "xpm";
    $mimetypes["image/x-xwindowdump"] 				= "xwd";
    $mimetypes["model/iges"] 						= "igs iges";
    $mimetypes["model/mesh"] 						= "msh mesh silo";
    $mimetypes["model/vrml"] 						= "wrl vrml";
    $mimetypes["text/css"] 							= "css";
    $mimetypes["text/html"] 						= "html htm";
    $mimetypes["text/plain"] 						= "asc txt";
    $mimetypes["text/richtext"] 					= "rtx";
    $mimetypes["text/rtf"] 							= "rtf";
    $mimetypes["text/sgml"] 						= "sgml sgm";
    $mimetypes["text/tab-separated-values"] 		= "tsv";
    $mimetypes["text/vnd.wap.wml"] 					= "wml";
    $mimetypes["text/vnd.wap.wmlscript"] 			= "wmls";
    $mimetypes["text/x-setext"] 					= "etx";
    $mimetypes["text/xml"] 							= "xml xsl";
    $mimetypes["video/mpeg"]						= "mpeg mpg mpe";
    $mimetypes["video/quicktime"] 					= "qt mov";
    $mimetypes["video/vnd.mpegurl"] 				= "mxu";
    $mimetypes["video/x-msvideo"] 					= "avi";
    $mimetypes["video/x-sgi-movie"] 				= "movie";
    $mimetypes["x-conference/x-cooltalk"] 			= "ice";
    
    $this->mimetypes = $mimetypes;
  }
  
  function getMIMEType($file)
  {
    //global $mimetypes;
    // Get the extension
    $pos = strrpos($file, ".");

    if ($pos !== false)
    {
      $ext = substr($file, $pos + 1);
    }
    else
    {
      return "text/plain";
    }

    // Find this extension in our MIME type array
    $mimetypes = $this->mimetypes;
    foreach($mimetypes as $tipo=>$mime)
    {
      if (eregi($ext, $mime))
      {
        //prev($mimetypes);
        //return key($mimetypes);
        return $tipo;
      }
    }

    // No MIME type found, return text/plain
    return "text/plain";
  }
  
}
?>
