<?
require_once "../includes/include_files.php";
require_once "../classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;

$filename = "keywords.txt";
$handle = @fopen($filename, "r");

if ($handle) {
    while (!feof($handle)) {
        $data = fgets($handle, 4096);

        //Process the data here
        if (trim($data)!="") {
            
            $contents = explode("\t", $data);

            $pageURL = trim($contents[1]);
            $pageTitle = addslashes(trim($contents[2]));
            $pageTitleFrench = addslashes(trim($contents[3]));
            $searchKeyword = addslashes(trim($contents[4]));
            $searchKeywordFrench = addslashes(trim($contents[5]));
            $searchDesc = addslashes(trim($contents[6]));
            $searchDescFrench = addslashes(trim($contents[7]));
            
            echo "Page URL = $pageURL <br> Title = $pageTitle <br> Title French = $pageTitleFrench <br> Keyword = $searchKeyword <br> Keyword French = $searchKeywordFrench <br> Desc = $searchDesc <br> Desc French = $searchDescFrench<br>";
            
            
            $query="SELECT * FROM tbl_search WHERE search_page_url='$pageURL'";
            //echo "<B>$query</B><br>";
            $obj->query($query);
            if ($obj->num_rows() < 1) {
                
                // INSERT RECORD
                $query = "INSERT INTO tbl_search(search_id, search_page_url, search_title, search_title_fr, search_keyword, search_keyword_fr, search_description, search_description_fr, search_status) VALUES('', '$pageURL', '$pageTitle', '$pageTitleFrench', '$searchKeyword', '$searchKeywordFrench', '$searchDesc', '$searchDescFrench', 'Y')";
                echo "<br>".$query."<br><br>";
                $obj->query($query);
            }
            else {
                
                $query="UPDATE tbl_search SET search_page_url='$pageURL', search_title='$pageTitle', search_title_fr='$pageTitleFrench', search_keyword='$searchKeyword', search_keyword_fr='$searchKeywordFrench', search_description='$searchDesc', search_description_fr='$searchDescFrench' WHERE search_page_url='$pageURL'";
                echo "<br>".$query."<br><br>";
                $obj->query($query);
            }
        }
    }
    fclose($handle);
    
echo "<br><br><B>DONE</B>";
}

//Dominican Rep.	1	0.129			
?>