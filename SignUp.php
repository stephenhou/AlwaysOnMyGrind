{\rtf1\ansi\ansicpg1252\cocoartf1404\cocoasubrtf460
{\fonttbl\f0\fnil\fcharset0 Menlo-Bold;\f1\fnil\fcharset0 Menlo-Italic;\f2\fnil\fcharset0 Menlo-Regular;
\f3\fnil\fcharset0 Menlo-BoldItalic;}
{\colortbl;\red255\green255\blue255;\red204\green120\blue50;\red35\green37\blue37;\red98\green151\blue85;
\red152\green118\blue170;\red169\green183\blue198;\red106\green135\blue89;\red104\green151\blue187;\red255\green198\blue109;
\red128\green128\blue128;}
\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx560\tx1120\tx1680\tx2240\tx2800\tx3360\tx3920\tx4480\tx5040\tx5600\tx6160\tx6720\pardirnatural\partightenfactor0

\f0\b\fs24 \cf2 \cb3 <?php\uc0\u8232 
\f1\i\b0 \cf4 /**\uc0\u8232  * Created by PhpStorm.\u8232  * User: joohan0311\u8232  * Date: 2016-06-11\u8232  * Time: 4:15 PM\u8232  */\u8232  /** this tells the system that it's no longer just parsing\u8232   * html; it's now parsing PHP\u8232   * keep track of errors so it redirects the page only if there are no errors\u8232   */\u8232 
\f2\i0 \cf5 $success \cf6 = 
\f0\b \cf2 True
\f2\b0 ;\uc0\u8232 \cf5 $db_conn \cf6 = OCILogon(\cf7 "ora_x3b0b"\cf2 , \cf7 "a15055149"\cf2 , \cf7 "ug"\cf6 )\cf2 ;\uc0\u8232 \cf5 $number \cf6 = mt_rand(\cf8 100000\cf2 , \cf8 999999\cf6 )\cf2 ;\uc0\u8232 
\f0\b function 
\f2\b0 \cf9 executePlainSQL\cf6 (\cf5 $cmdstr\cf6 ) \{\uc0\u8232     
\f1\i \cf4 /**takes a plain (no bound variables) SQL command and executes it\uc0\u8232      * echo "<br>running ".$cmdstr."<br>";\u8232      */\u8232     
\f0\i0\b \cf2 global 
\f2\b0 \cf5 $db_conn\cf2 , \cf5 $success\cf2 ;\uc0\u8232     \cf5 $statement \cf6 = OCIParse(\cf5 $db_conn\cf2 , \cf5 $cmdstr\cf6 )\cf2 ;\uc0\u8232     
\f1\i \cf4 /**There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work\uc0\u8232      */\u8232     
\f0\i0\b \cf2 if 
\f2\b0 \cf6 (!\cf5 $statement\cf6 ) \{\uc0\u8232         
\f0\b \cf2 echo 
\f2\b0 \cf7 "<br>Cannot parse the following command: " \cf6 . \cf5 $cmdstr \cf6 . \cf7 "<br>"\cf2 ;\uc0\u8232         \cf5 $e \cf6 = OCI_Error(\cf5 $db_conn\cf6 )\cf2 ;\uc0\u8232         
\f0\b echo 
\f2\b0 \cf6 htmlentities(\cf5 $e\cf6 [\cf7 'message'\cf6 ])\cf2 ;\uc0\u8232         \cf5 $success \cf6 = 
\f0\b \cf2 False
\f2\b0 ;\uc0\u8232     \cf6 \}\uc0\u8232 \u8232     \cf5 $r \cf6 = OCIExecute(\cf5 $statement\cf2 , 
\f1\i \cf5 OCI_DEFAULT
\f2\i0 \cf6 )\cf2 ;\uc0\u8232     
\f0\b if 
\f2\b0 \cf6 (!\cf5 $r\cf6 ) \{\uc0\u8232         
\f0\b \cf2 echo 
\f2\b0 \cf7 "<br>Cannot execute the following command: " \cf6 . \cf5 $cmdstr \cf6 . \cf7 "<br>"\cf2 ;\uc0\u8232         \cf5 $e \cf6 = oci_error(\cf5 $statement\cf6 )\cf2 ;\uc0\u8232         
\f0\b echo 
\f2\b0 \cf6 htmlentities(\cf5 $e\cf6 [\cf7 'message'\cf6 ])\cf2 ;\uc0\u8232         \cf5 $success \cf6 = 
\f0\b \cf2 False
\f2\b0 ;\uc0\u8232     \cf6 \} 
\f0\b \cf2 else 
\f2\b0 \cf6 \{\uc0\u8232 \u8232     \}\u8232     
\f0\b \cf2 return 
\f2\b0 \cf5 $statement\cf2 ;\uc0\u8232 \cf6 \}\uc0\u8232 
\f0\b \cf2 function 
\f2\b0 \cf9 executeBoundSQL\cf6 (\cf5 $cmdstr\cf2 , \cf5 $list\cf6 ) \{\uc0\u8232     
\f1\i \cf4 /** Sometimes a same statement will be excuted for severl times, only\uc0\u8232      the value of variables need to be changed.\u8232      In this case you don't need to create the statement several times;\u8232      using bind variables can make the statement be shared and just\u8232      parsed once. This is also very useful in protecting against SQL injection. See example code below for\u8232      how this functions is used */\u8232     
\f0\i0\b \cf2 global 
\f2\b0 \cf5 $db_conn\cf2 , \cf5 $success\cf2 ;\uc0\u8232     \cf5 $statement \cf6 = OCIParse(\cf5 $db_conn\cf2 , \cf5 $cmdstr\cf6 )\cf2 ;\uc0\u8232 \u8232     
\f0\b if 
\f2\b0 \cf6 (!\cf5 $statement\cf6 ) \{\uc0\u8232         
\f0\b \cf2 echo 
\f2\b0 \cf7 "<br>Cannot parse the following command: " \cf6 . \cf5 $cmdstr \cf6 . \cf7 "<br>"\cf2 ;\uc0\u8232         \cf5 $e \cf6 = OCI_Error(\cf5 $db_conn\cf6 )\cf2 ;\uc0\u8232         
\f0\b echo 
\f2\b0 \cf6 htmlentities(\cf5 $e\cf6 [\cf7 'message'\cf6 ])\cf2 ;\uc0\u8232         \cf5 $success \cf6 = 
\f0\b \cf2 False
\f2\b0 ;\uc0\u8232     \cf6 \}\uc0\u8232 \u8232     
\f0\b \cf2 foreach 
\f2\b0 \cf6 (\cf5 $list 
\f0\b \cf2 as 
\f2\b0 \cf5 $tuple\cf6 ) \{\uc0\u8232         
\f0\b \cf2 foreach 
\f2\b0 \cf6 (\cf5 $tuple 
\f0\b \cf2 as 
\f2\b0 \cf5 $bind \cf6 => \cf5 $val\cf6 ) \{\uc0\u8232             \cf10 //echo $val;\uc0\u8232             //echo "<br>".$bind."<br>";\u8232             \cf6 OCIBindByName(\cf5 $statement\cf2 , \cf5 $bind\cf2 , \cf5 $val\cf6 )\cf2 ;\uc0\u8232             
\f0\b unset 
\f2\b0 \cf6 (\cf5 $val\cf6 )\cf2 ; \cf10 //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype\uc0\u8232 \u8232         \cf6 \}\uc0\u8232         \cf5 $r \cf6 = OCIExecute(\cf5 $statement\cf2 , 
\f1\i \cf5 OCI_DEFAULT
\f2\i0 \cf6 )\cf2 ;\uc0\u8232         
\f0\b if 
\f2\b0 \cf6 (!\cf5 $r\cf6 ) \{\uc0\u8232             
\f0\b \cf2 echo 
\f2\b0 \cf7 "<br>Cannot execute the following command: " \cf6 . \cf5 $cmdstr \cf6 . \cf7 "<br>"\cf2 ;\uc0\u8232             \cf5 $e \cf6 = OCI_Error(\cf5 $statement\cf6 )\cf2 ; \cf10 // For OCIExecute errors pass the statementhandle\uc0\u8232             
\f0\b \cf2 echo 
\f2\b0 \cf6 htmlentities(\cf5 $e\cf6 [\cf7 'message'\cf6 ])\cf2 ;\uc0\u8232             
\f0\b echo 
\f2\b0 \cf7 "<br>"\cf2 ;\uc0\u8232             \cf5 $success \cf6 = 
\f0\b \cf2 False
\f2\b0 ;\uc0\u8232         \cf6 \}\uc0\u8232     \}\u8232 \}\u8232 
\f0\b \cf2 function 
\f2\b0 \cf9 printResult\cf6 (\cf5 $result\cf6 ) \{ \cf10 //prints results from a select statement\uc0\u8232     
\f0\b \cf2 echo 
\f2\b0 \cf7 "<br>Got data from table tab1:<br>"\cf2 ;\uc0\u8232     
\f0\b echo 
\f2\b0 \cf7 "<table>"\cf2 ;\uc0\u8232     
\f0\b echo 
\f2\b0 \cf7 "<tr><th>ID</th><th>Name</th></tr>"\cf2 ;\uc0\u8232 \u8232     
\f0\b while 
\f2\b0 \cf6 (\cf5 $row \cf6 = OCI_Fetch_Array(\cf5 $result\cf2 , 
\f1\i \cf5 OCI_BOTH
\f2\i0 \cf6 )) \{\uc0\u8232         
\f0\b \cf2 echo 
\f2\b0 \cf7 "<tr><td>" \cf6 . \cf5 $row\cf6 [\cf7 "NID"\cf6 ] . \cf7 "</td><td>" \cf6 . \cf5 $row\cf6 [\cf7 "NAME"\cf6 ] . \cf7 "</td></tr>"\cf2 ; \cf10 //or just use "echo $row[0]"\uc0\u8232     \cf6 \}\uc0\u8232     
\f0\b \cf2 echo 
\f2\b0 \cf7 "</table>"\cf2 ;\uc0\u8232 \u8232 \cf6 \}\uc0\u8232 
\f0\b \cf2 function 
\f2\b0 \cf9 generateUniqueId\cf6 (\cf5 $number\cf6 ) \{\uc0\u8232     
\f0\b \cf2 global 
\f2\b0 \cf5 $db_conn\cf2 , \cf5 $number\cf2 ;\uc0\u8232     \cf5 $statement \cf6 = OCIParse(\cf5 $db_conn\cf2 , \cf7 'select gid from gymBro'\cf6 )\cf2 ;\uc0\u8232     \cf5 $r \cf6 = OCIExecute(\cf5 $statement\cf2 , 
\f1\i \cf5 OCI_DEFAULT
\f2\i0 \cf6 )\cf2 ;\uc0\u8232     
\f0\b if 
\f2\b0 \cf6 (\cf5 $r\cf6 ) \{\uc0\u8232         
\f1\i \cf4 /**  $fetcharray = existing gid values from gymBro */\uc0\u8232         
\f2\i0 \cf5 $fetchArray \cf6 = oci_fetch_array(\cf5 $statement\cf2 , 
\f1\i \cf5 OCI_NUM
\f2\i0 \cf6 )\cf2 ;\uc0\u8232         
\f0\b if 
\f2\b0 \cf6 (!in_array(\cf5 $number\cf2 ,\cf5 $fetchArray\cf6 )) \{\uc0\u8232             
\f0\b \cf2 return 
\f2\b0 \cf5 $number\cf2 ;\uc0\u8232         \cf6 \}\uc0\u8232         
\f0\b \cf2 else 
\f2\b0 \cf6 \{\uc0\u8232             \cf5 $newNumber \cf6 = mt_rand(\cf8 100000\cf2 , \cf8 999999\cf6 )\cf2 ;\uc0\u8232             
\f0\b return 
\f2\b0 \cf6 generateUniqueId(\cf5 $newNumber\cf6 )\cf2 ;\uc0\u8232         \cf6 \}\uc0\u8232     \}\u8232 \}\u8232 
\f0\b \cf2 if 
\f2\b0 \cf6 (\cf5 $db_conn\cf6 ) \{\uc0\u8232     
\f0\b \cf2 if 
\f2\b0 \cf6 (array_key_exists(\cf7 'signupsubmit'\cf2 , \cf5 $_POST\cf6 )) \{\uc0\u8232       
\f1\i \cf4 /**Getting the values from user and insert data into the table\uc0\u8232        */\u8232       
\f2\i0 \cf5 $tuple \cf6 = 
\f0\b \cf2 array 
\f2\b0 \cf6 (\uc0\u8232             \cf7 ":bind0" \cf6 => generateUniqueId(\cf5 $number\cf6 )\cf2 ,\uc0\u8232             \cf7 ":bind1" \cf6 => \cf5 $_POST\cf6 [\cf7 'insFirstName'\cf6 ].\cf7 ''\cf6 .\cf5 $_POST\cf6 [\cf7 'insLastName'\cf6 ]\cf2 ,\uc0\u8232             \cf7 ":bind2" \cf6 => \cf5 $_POST\cf6 [\cf7 'insEmail'\cf6 ]\cf2 ,\uc0\u8232             \cf7 ":bind3" \cf6 => \cf5 $_POST\cf6 [\cf7 'insUserName'\cf6 ]\cf2 ,\uc0\u8232             \cf7 ":bind4" \cf6 => \cf5 $_POST\cf6 [\cf7 'insPass'\cf6 ]\uc0\u8232         )\cf2 ;\uc0\u8232         \cf5 $alltuples \cf6 = 
\f0\b \cf2 array 
\f2\b0 \cf6 (\uc0\u8232         \cf5 $tuple\uc0\u8232         \cf6 )\cf2 ;\uc0\u8232         \cf6 executeBoundSQL(\cf7 "insert into gymBro values (:bind0, :bind1, :bind2, :bind3, :bind4)"\cf2 , \cf5 $alltuples\cf6 )\cf2 ;\uc0\u8232         \cf6 OCICommit(\cf5 $db_conn\cf6 )\cf2 ;\uc0\u8232     \cf6 \}\uc0\u8232     
\f0\b \cf2 if 
\f2\b0 \cf6 (\cf5 $_POST \cf6 && \cf5 $success\cf6 ) \{\uc0\u8232       
\f1\i \cf4 /**POST-REDIRECT-GET -- See 
\f3\b http://en.wikipedia.org/wiki/Post/Redirect/Get\uc0\u8232        
\f1\b0 */\uc0\u8232         
\f2\i0 \cf6 header(\cf7 "location: oracle-test.php"\cf6 )\cf2 ;\uc0\u8232     \cf6 \} 
\f0\b \cf2 else 
\f2\b0 \cf6 \{\uc0\u8232       
\f1\i \cf4 /** Select data...\uc0\u8232        */\u8232       
\f2\i0 \cf5 $result \cf6 = executePlainSQL(\cf7 "select \cf9 *\cf7  from gymBro"\cf6 )\cf2 ;\uc0\u8232       \cf6 printResult(\cf5 $result\cf6 )\cf2 ;\uc0\u8232     \cf6 \}\uc0\u8232     
\f1\i \cf4 /**Commit to save changes... */\uc0\u8232     
\f2\i0 \cf6 OCILogoff(\cf5 $db_conn\cf6 )\cf2 ;\uc0\u8232 \cf6 \} 
\f0\b \cf2 else 
\f2\b0 \cf6 \{\uc0\u8232     
\f0\b \cf2 echo 
\f2\b0 \cf7 "cannot connect"\cf2 ;\uc0\u8232     \cf5 $e \cf6 = OCI_Error()\cf2 ; \cf10 // For OCILogon errors pass no handle\uc0\u8232     
\f0\b \cf2 echo 
\f2\b0 \cf6 htmlentities(\cf5 $e\cf6 [\cf7 'message'\cf6 ])\cf2 ;\uc0\u8232 \cf6 \}\uc0\u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \u8232 \
}