<?php require_once('../Connections/localhost.php'); ?>
<?php
session_start();
$clhq=$_GET['clhq'];
$v=$_SESSION["License"];

$db=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error()); 
$mydb=mysql_select_db("newmed06");
$sql="    		
SELECT
    client.License
    , client.Client_Headquaters
    , client.LId
    , client.Created
    , client.Creator
    , client.Client
    , client.Short
    , client.Business_FK
    , client.Address
    , client.Country_FK
    , client.State_FK
    , client.LGA_FK
    , client.City
    , client.Postcode
    , client.NHIS_Reg_No
    , client.NHIS_Registered
    , client.Contact
    , client.Contact_Business_Phone
    , client.Contact_Mobile_Phone
    , client.Contact_Email
    , client.Contact_Job_Title
    , client_hqs.CAC_Reg_No
    , client_hqs.Ownership_FK
    , client_hqs.Web_Page
    , client_hqs.Logo
    , client_hqs.NHMIS_HF_CODE
    , client_hqs.Statement
    , country.Country
    , state.State
    , lga.LGA
FROM
    newmed06.client
    LEFT JOIN newmed06.client_hqs 
        ON (client.Client_Headquaters = client_hqs.Client)
    LEFT JOIN newmed06.country 
        ON (client.Country_FK = country.CId)
    LEFT JOIN newmed06.state 
        ON (client.State_FK = state.Id)
    LEFT JOIN newmed06.lga 
        ON (client.LGA_FK = lga.Id) WHERE client.License=$v AND client.LId=$clhq";  

	
	
	
	
	

$result=mysql_query($sql); 
while($row=mysql_fetch_array($result))
{

 
  $nhisno =$row['NHIS_Reg_No'];
  $nhisrd =$row['NHIS_Registered'];
  $postalcode =$row['Postcode'];
  $country =$row['Country'];
  $state =$row['State'];
 
  $lga =$row['LGA'];
  $city =$row['City'];
  $add =$row['Address'];
  $lname =$row['Client'];


  $contact =$row['Contact'];
  $contactt =$row['Contact_Job_Title'];
  $mphone =$row['Contact_Mobile_Phone'];
  $bphone =$row['Contact_Business_Phone'];
  $contacte =$row['Contact_Email'];
  $created =$row['Created'];
  $creator =$row['Creator'];
  $country_fk=$row['Country_FK'];
  $lga_fk =$row['LGA_FK'];
  $state_fk=$row['State_FK'];
   $short= $row['Short'];
  $webpage= $row['Web_Page'];
  $CAC_reg_no= $row['CAC_Reg_No'];
  $Statement= $row['Statement'];
  $NHMIS_HF_Code= $row['NHMIS_HF_CODE'];

  
 }
 


?> 

<div id="total" style="position:relative; background-color:#e5e5e5">


<div  style="position:absolute; width:100%; left:0px;">
<table  width="100%" border="0" style="font-weight:bold;">
              <tr>
                <td  width="32%" height="20">
                </td>
              </tr>
            </table> </div>
<div style="position:relative;"> 
    <div id="contact">
   <div id="h1"  style="background: url(../images/nav-bg.png) repeat-x; width:100px; height:100%; float:left; color:#FFF"><?php echo "<a class=\"links\" onClick=\"getData('hq.php?clhq=$clhq')\">"   . "Hospital" ."</a></li>\n"; ?></div>
   <div style="background: url(../images/nav-bg-hover.png) repeat-x; width:100px; height:100%; float:left; color:#FFF;">Licensee</div>
    </div>
    
    <?php 
//total number of licenses for each lhq

$sqlall="  SELECT COUNT(LId) AS coun FROM newmed06.Client WHERE client.License=$v AND client.Client_Headquaters=$clhq;";
$resultall=mysql_query($sqlall); 
$rowall=mysql_fetch_array($resultall);
$lcount=$rowall['coun'];
$num=0;



?>
    <div id="contact1">
                         
    <input   align="middle"style=" float:left; height:12px" name=""  disabled="disabled" type="text"  
    
    
    value="<?php echo "1"."of ".$lcount?>"/>
<?php 
$endnum=$lcount-2;
	 if ($lcount>$num+1){
echo "<img style=\"float:left\"; src=\"../images/icons/list_normal.png\" width=\"16\" height=\"16\" onClick=\"getData('branchf.php?clhq=$clhq&num=$num&lcount=$lcount')\"/>";
 echo   "<img style=\"float:left\"; src=\"../images/icons/min - Copy.gif\" width=\"16\" height=\"16\" onClick=\"getData('branchf.php?clhq=$clhq&num=$endnum&lcount=$lcount')\"/>" ; }?>
<?php        echo "<img style=\"float:left\"; src=\"../images/icons/error.png\"  width=\"16\" height=\"16\" onClick=\"getData('new1.php?clhq=$clhq&webpage=$webpage&CAC_reg_no=$CAC_reg_no&Statement=$Statement&NHMIS_HF_Code=$NHMIS_HF_Code  ')\"/>";?></div>
            
      
    <div id="d1">
      <table  class="sample">
        <tr class="header">
          <td>Licensee</td>
        </tr>
        <tr  class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Long Name</label><input type="text" name="textfield" id="textfield" value="<?php   echo $lname; ?>" style="height:100%;"/>
            
          </td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Short Name</label><input type="text" name="textfield2"  value="<?php   echo $short; ?>" id="textfield2"  style="height:100%;"  />
           
          </td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >NHIS No.\ Date</label><input type="text" name="textfield3" id="textfield3"  value="<?php   echo $nhisno; ?>"  style="width:19%;  height:100%;"/><input type="text" value="<?php   echo $nhisrd; ?>"name="textfield3" id="textfield3" style="width:19%;  height:100%;"  />
            
          </td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Business</label><select name="select" id="select" style="height:100%; width:157px;"> </select>
            
          </td>
        </tr>
      </table>
    </div>
    <div id="d2">
    <table  class="sample">
        <tr class="header">
          <td>Licensing</td>
        </tr>
        <tr class="tablebody">
          <td>           
          </td>
        </tr>
        <tr class="tablebody">
          <td>            
          </td>
        </tr>
        <tr class="tablebody">
          <td>
            
         </td>
        </tr>
        <tr>
       
        </tr>
      </table>
    </div>
    <div id="d3"><table  class="sample">
        <tr class="header">
          <td>Primary contact</td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >contact</label><input type="text" value="<?php   echo $contact; ?>" name="textfield" id="textfield" style="height:100%;"/></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Job Title</label><input type="text" name="textfield2" id="textfield2" value="<?php   echo $contactt; ?>" style="height:100%;" /></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Business Phone</label><input type="text" name="textfield2" id="textfield2" value="<?php   echo $bphone; ?>"  style="height:100%;"/></td>
            
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Mobile Phone</label><input type="text" value="<?php   echo $mphone; ?>"  name="textfield2" id="textfield2" style="height:100%;" /></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Email</label><input type="text" name="textfield2" id="textfield2" style="height:100%;" value="<?php   echo $contacte; ?>"/></td>
        </tr>
      </table>
    </div>
    <div id="d4"><table  class="sample">
        <tr class="header">
          <td>Address</td>
        </tr>
        <tr>
          <td><textarea name="textarea" id="textarea" cols="45" rows="5" style="height:62px; width:98%;"><?php   echo $add; ?></textarea></td>
        </tr>
        <tr  class="tablebody">
          <td><label  style="display:inline-block; width:70px; " >Country</label><select name="select2" id="select2" style="height:100%;">
            <option value="1">Nigeria</option>
          </select>
              
              <label  style="display:inline-block; width:70px; " >State</label><select name="select2" id="select2" style="height:100%;">
                <option value="2">Lagos</option>
              </select>
              LGA<select name="select2" id="select2" style="height:100%;">
                <option>IKg</option>
              </select>
          
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >City/Postal code</label><input type="text" name="textfield2" id="textfield2" style="height:100%; width:50px;" value="<?php   echo $city; ?>" /><input type="text" name="textfield2" id="textfield2"  value="<?php   echo $postalcode; ?>" style="height:100% ;width:50px;" /></td>
        </tr>
      </table>
    </div>
    <div id="d5"><table  class="sample">
        <tr class="header">
          <td>Hosptial info</td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Webpage</label><input type="text"  disabled="disabled"name="textfield4" 
          value="<?php   echo $webpage; ?>"id="textfield4"  style="height:100%;"/>
          </td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >CAC Reg No.</label><input type="text"  disabled="disabled"name="textfield2" id="textfield2" style="height:100%;" value="<?php   echo $CAC_reg_no; ?>"/></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >Ownership</label><select name="select"  disabled="disabled"id="select" style="height:100%; width:157px;"> </select></td>
        </tr>
        <tr class="tablebody">
          <td><label  style="display:inline-block; width:150px; " >NHMIS HF Code</label><input  disabled="disabled"type="text" name="textfield2" id="textfield2" style="height:100%;"  value="<?php   echo $NHMIS_HF_Code; ?>" /></td>
        </tr>
    </table></div>
      <div id="d6"><table  class="sample">
        <tr class="header">
          <td>Mission Statement</td>
        </tr>
        <tr>
          <td><label>
            <textarea name="textarea" id="textarea" cols="45" rows="5"  disabled="disabled"style="height:60px; width:98%;"><?php echo $Statement; ?></textarea>
          </label></td>
        </tr>
      </table></div>
        
</div>
   
             
             
                
               
</div>

          
    
      </div>  
        
    
        


