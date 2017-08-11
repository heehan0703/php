<?php 
/******************************************************************************************************
* 											HOW TO USE
*	0) First of include this file using include('pager.php');
*	1) When you call query use mysql_query(dopaging($sql,$limit));
*	2) The place where you want to display page number links, write the following
*		<? echo rightpaging(); ?>
*	With these two things you have successfully implemented paging in the page.
*******************************************************************************************************/
class Pager{
  /*********************************************************************************** 
   * int findStart (int limit) 
   * Returns the start offset based on $_GET['page'] and $limit 
   ***********************************************************************************/ 
   function findStart($limit){
	 if ((!isset($_GET['page'])) || ($_GET['page'] == "1")) 
      { 
       $start = 0;
       $_GET['page'] = 1;
      }
     else
      { 
       $start = ($_GET['page']-1) * $limit; 
      } 
     return $start; 
    } 
  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
   function findPages($count, $limit){
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; 
     return $pages; 
    } 
  /*********************************************************************************** 
   * string pageList (int curpage, int pages) 
   * Returns a list of pages in the format of "« < [pages] > »" 
   ***********************************************************************************/ 
   function pageList($curpage, $pages){
    $page_list  = "";
	 $str = "";
	 foreach( $_GET as $key=>$value)
	 {
	    if ($key=="message" || $key=="page" || $key=="pagegroup"){}
		else
		 $str = $str."&".$key."=".$value;
	 }	  
	foreach( $_POST as $key=>$value)
	{
		if ($key=="message" || $key=="page" || $key=="pagegroup"){}
		else
		 $str = $str."&".$key."=".$value;
	}	  
$pagegroup = $_REQUEST['pagegroup'];
$limitset = 10;
if ($pagegroup== ""){
	    $pagegroup = 1;
		}
     /* Print the first and previous page links if necessary */ 
   /* if (($curpage != 1) && ($curpage)) 
      { 
	    $str1 = $str . "&pagegroup=1";
       $page_list .= "  <a href=\"".$_SERVER['PHP_SELF']."?page=1".$str1."\" title=\"First Page\" class="top-link"><font color=#ff0000>«</font></a> "; 
      } */
	$prevgrouppage = ($pagegroup - 1) * ($limitset);
	if (($prevgrouppage) > 0) 
    { 
	   $str1 = $str . "&pagegroup=" . ($pagegroup-1);
	   $spage = ($limitset*($pagegroup-1)) + 1 - $limitset;
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($spage).$str1."\" title=\"Previous Page\" class=\"blue-12\"><b>Previous $limitset pages..</b></a> ";
    } 
  	$startpage = (($pagegroup - 1) * $limitset);
     /* Print the numeric page list; make the current page unlinked and bold */ 
     for ($i=$startpage+1; $i<=$pages; $i++) 
     { 
	    $str1 = $str . "&pagegroup=" . $pagegroup;
	  if ($i > ($startpage + $limitset))
		      break;
       if ($i == $curpage) 
       { 
	        // c h a n g e   l i n k s   c l a s s    h e r e
         $page_list .= ""."<span class=\"red-18\"><b>".$i."</b></span>"; 
       } 
       else 
       { 
         $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i.$str1."\" title=\"Page ".$i."\" class='blue-12'>".$i."</a>";
       } 
       $page_list .= " "; 
     } 
    $nextgrouppage = $pagegroup * $limitset;
     /* Print the Next and Last page links if necessary */ 
     if (($nextgrouppage+1) <= $pages) 
     { 
	   $str1 = $str . "&pagegroup=" . ($pagegroup+1);
	   $spage = ($limitset*$pagegroup) + 1;
	   $page_list .="<a href=\"".$_SERVER['PHP_SELF']."?page=".($spage).$str1."\" title=\"Next PageSet\" class=\"blue-12\"><b>..Next $limitset Pages</b></a> ";
     } 
     $page_list .= "\n"; 
     return $page_list; 
    } 
  /*********************************************************************************** 
   * string nextPrev (int curpage, int pages) 
   * Returns "Previous | Next" string for individual pagination (it's a word!) 
   ***********************************************************************************/ 
   function nextPrev($curpage, $pages) 
   { 
     $next_prev  = ""; 
     $page_list  = "";
	 $str = "";
	 foreach( $_GET as $key=>$value)
	 {
	    if ($key=="message" || $key=="page"){}
		else
		 $str = $str."&".$key."=".$value;
	 }
	 foreach( $_POST as $key=>$value)
	 {
	    if ($key=="message" || $key=="page"){}
		else
		 $str = $str."&".$key."=".$value;
	   }	  	  
     if (($curpage-1) <= 0) 
      { 
       $next_prev .= "<span class=\"pager_active\">Prev</span>"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage-1).$str."\" class=pager>Prev</a>"; 
      } 
     $next_prev .= " <font color=#000000>&nbsp;</font> "; 
     if (($curpage+1) > $pages) 
      { 
       $next_prev .= "<span class=pager_active>Next</span>"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=".($curpage+1).$str."\" class=pager>Next</a>"; 
      } 
     $next_prev .= "\n";
     return $next_prev; 
    } 
  } 

				function showmsg($text,$type,$align='left')
				{
					switch($type)
					{
						case "0":
							$color = "#EC461F";
						break;
						case "1":
							$color = "green";
						break;
					}
					?>
					<p align=<?=$align?> style="font-family:arial; font-size:11px; color:<?=$color?>;padding:4px;"><?php echo $text; ?></p>
					<?
				}			
			function readmyfile($path)
				{
					$text='';
					$fp = fopen($path,"r") or die("Invalid Path");
					while (!@feof($fp))
					{
					$buffer = @fgets($fp, 4096);
					$text.= $buffer;
					}
					@fclose($fp);
					return $text;
				}	
			function dopaging($sql,$limit = 1,$numrecords=0)
					{
					global $clspg;
					global $pages;
					$clspg = new Pager;
					$start = $clspg->findStart($limit); 
					$temp = mysql_query($sql) or die(mysql_error());
					$numrows = mysql_num_rows($temp);
					if ($numrecords == 0)
					  $pages = $clspg->findPages($numrows, $limit);
					else{
					if ($numrows > $numrecords)   
					  $pages = $clspg->findPages($numrecords, $limit);
					else
					  $pages = $clspg->findPages($numrows, $limit);
					}
					if ($numrecords == 0)
					  $sql1 = $sql . " LIMIT " . $start. ", ". $limit ;
					else{
					 if (($start + $limit) > $numrecords) 
					   $sql1 = $sql . " LIMIT " . $start. ", ". ($numrecords - $start);
					 else
					   $sql1 = $sql . " LIMIT " . $start. ", ". $limit ;
					}
					return $sql1;
					}
			function leftpaging()
					{
					global $clspg;
					global $pages;
					$pagelist = "";
					#if (trim($clspg) != "")
					  if ($pages > 1)
						 $pagelist = $clspg->nextprev($_GET['page'], $pages);
					return $pagelist;
					}
			function rightpaging()
					{
					global $clspg;
					global $pages;
					$pagelist = "";
					
					  if ($pages > 1)
						 $pagelist = $clspg->pageList($_GET['page'], $pages);
					return $pagelist;
					}
?>