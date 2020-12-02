<html>
   
   <head>
      <title>Update a Record in pg Database</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
   </head>
   
   <body>
      <?php
         if(isset($_POST['update'])) {
        
            $conn = pg_connect("host=localhost dbname=EBilly user=postgres password=WelKom7993");
            
            if(! $conn ) {
               die('Could not connect: ');
            }
            
            $onderwerp = $_POST['onderwerp'];
            $wat = $_POST['wat'];
            $why = $_POST['why'];
            $how = $_POST['how'];
            $studieduur = $_POST['studieduur'];
            $rating = $_POST['rating'];
            $bronnen = $_POST['bronnen'];
            

            $checkbox1=$_POST['niveau'];
            $niveau="";  
            foreach($checkbox1 as $niveau1)  
           {  
              $niveau .= $niveau1."";  
           } 
        
           $checkbox2=$_POST['rol'];
            $rol="";  
            foreach($checkbox2 as $rol1)  
           {  
              $rol .= $rol1.",";  
           } 
        
           $checkbox3=$_POST['competentie'];
            $competentie="";  
            foreach($checkbox3 as $competentie1)  
           {  
              $competentie .= $competentie1.",";  
           } 

            $sql = "UPDATE sch_map.kenniskaart ". "SET wat = $wat, why = $why, how = $how, rol = $rol, niveau = $niveau, competentie = $competentie, studieduur = $studieduur, rating = $rating, bronnen = $bronnen ". 
               "WHERE onderwerp = $onderwerp" ;
            pg_select ($connection, $table_name, array ($assoc_array, $options = PGSQL_DML_EXEC, $result_type = PGSQL_ASSOC));
            $retval = pg_query( $sql, $conn );
            
            if(! $retval ) {
               die('Could not update data: ');
            }
            echo "Updated data successfully\n";
            
            pg_close($conn);
         }else {
            ?>
               <form action="dataUpdate.php" enctype="multipart/form-data" action = "dataUpdate.php">
                  <table width = "400" cellspacing = "1" 
                     cellpadding = "2">
                  
                     <tr>
                        <td width = "100">onderwerp</td>
                        <td><input name = "onderwerp" type = "text" 
                           id = "onderwerp"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">wat</td>
                        <td><input name = "wat" type = "text" 
                           id = "wat"></td>
                     </tr>

                     <tr>
                        <td width = "100">why</td>
                        <td><input name = "why" type = "text" 
                           id = "why"></td>
                     </tr>

                     <tr>
                        <td width = "100">how</td>
                        <td><input name = "how" type = "text" 
                           id = "how"></td>
                     </tr>
                     <tr>
                        <label class="label"for = "niveau">Niveau:</label><br>
                        <div class="niveau_block" required>
                            <input class="invulbox" type = "checkbox" id="niveau1" name = "niveau[]" value="Beginner">
                            <label class="checkbox"for ="niveau1">Beginner</label><br>
                            <input class="invulbox" type = "checkbox" id="niveau2" name = "niveau[]" value="Gevorderde">
                            <label class="checkbox"for ="niveau2">Gevorderde</label><br>
                            <input class="invulbox" type = "checkbox" id="niveau3" name = "niveau[]" value="Expert">
                            <label class="checkbox"for ="niveau3">Expert</label><br>
                            <script type="text/javascript">
                                $('.invulbox').on('change', function() {
                                    $('.invulbox').not(this).prop('checked', false);  
                                });
                            </script>
                        </div>
                     </tr>
                     <tr>
                        <label class="label"for = "rol">Rol:</label><br>
                        <div class="check_block" required>
                            <input class="invulbox2" type = "checkbox" id="rol1" name = "rol[]" value="FE">
                            <label class="checkbox2"for ="niveau1">FE</label><br>
                            <input class="invulbox2" type = "checkbox" id="rol2" name = "rol[]" value="BE">
                            <label class="checkbox2"for ="niveau2">BE</label><br>
                            <input class="invulbox2" type = "checkbox" id="rol3" name = "rol[]" value="AI">
                            <label class="checkbox2"for ="niveau3">AI</label><br>
                            <input class="invulbox2" type = "checkbox" id="rol4" name = "rol[]" value="PO">
                            <label class="checkbox2"for ="niveau1">PO</label><br>
                            <input class="invulbox2" type = "checkbox" id="rol5" name = "rol[]" value="CSC">
                            <label class="checkbox2"for ="niveau2">CSC</label><br>
                            <input class="invulbox2" type = "checkbox" id="rol6" name = "rol[]" value="UX Designer">
                            <label class="checkbox2"for ="niveau3">UX Designer</label><br>
                        </div>
                     </tr>
                     <tr>
                        <label class="label"for = "competentie">Competentie:</label><br>
                        <div class="ow_block" required>
                            <input class="invulbox3" type = "checkbox" id="competentie1" name="competentie[]" value="Gebruikersinteractie Analyseren">
                            <label class="checkbox3" for ="competentie1">Gebruikersinteractie Analyseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie2" name="competentie[]" value="Gebruikersinteractie Adviseren">
                            <label class="checkbox3" for ="competentie2">Gebruikersinteractie Adviseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie3" name="competentie[]" value="Gebruikersinteractie Ontwerpen">
                            <label class="checkbox3" for ="competentie3">Gebruikersinteractie Ontwerpen</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie4" name="competentie[]" value="Gebruikersinteractie Realiseren">
                            <label class="checkbox3" for ="competentie4">Gebruikersinteractie Realiseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie5" name="competentie[]" value="Gebruikersinteractie Manage & control">
                            <label class="checkbox3" for ="competentie5">Gebruikersinteractie Manage & control</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie" name="competentie[]" value="Organisatieprocessen Analyseren">
                            <label class="checkbox3" for ="competentie6">Organisatieprocessen Analyseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie7" name="competentie[]" value="Organisatieprocessen Adviseren">
                            <label class="checkbox3" for ="competentie7">Organisatieprocessen Adviseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie8" name="competentie[]" value="Organisatieprocessen Ontwerpen">
                            <label class="checkbox3" for ="competentie8">Organisatieprocessen Ontwerpen</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie9" name="competentie[]" value="Organisatieprocessen Realiseren">
                            <label class="checkbox3" for ="competentie9">Organisatieprocessen Realiseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie10" name="competentie[]" value="Organisatieprocessen Manage & control">
                            <label class="checkbox3" for ="competentie10">Organisatieprocessen Manage & control</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie11" name="competentie[]" value="Infrastructuur Analyseren">
                            <label class="checkbox3" for ="competentie11">Infrastructuur Analyseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie12" name="competentie[]" value="Infrastructuur Adviseren">
                            <label class="checkbox3" for ="competentie12">Infrastructuur Adviseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie13" name="competentie[]" value="Infrastructuur Ontwerpen">
                            <label class="checkbox3" for ="competentie13">Infrastructuur Ontwerpen</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie14" name="competentie[]" value="Infrastructuur Realiseren">
                            <label class="checkbox3" for ="competentie14">Infrastructuur Realiseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie15" name="competentie[]" value="Infrastructuur Manage & control">
                            <label class="checkbox3" for ="competentie15">Infrastructuur Manage & control</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie16" name="competentie[]" value="Software Analyseren">
                            <label class="checkbox3" for ="competentie16">Software Analyseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie17" name="competentie[]" value="Software Adviseren">
                            <label class="checkbox3" for ="competentie17">Software Adviseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie18" name="competentie[]" value="Software Ontwerpen">
                            <label class="checkbox3" for ="competentie18">Software Ontwerpen</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie19" name="competentie[]" value="Software Realiseren">
                            <label class="checkbox3" for ="competentie19">Software Realiseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie20" name="competentie[]" value="Software Manage & control">
                            <label class="checkbox3" for ="competentie20">Software Manage & control</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie21" name="competentie[]" value="Hardware interfacing Analyseren">
                            <label class="checkbox3" for ="competentie21">Hardware interfacing Analyseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie22" name="competentie[]" value="Hardware interfacing Adviseren">
                            <label class="checkbox3" for ="competentie22">Hardware interfacing Adviseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie23" name="competentie[]" value="Hardware interfacing Ontwerpen">
                            <label class="checkbox3" for ="competentie23">Hardware interfacing Ontwerpen</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie24" name="competentie[]" value="Hardware interfacing Realiseren">
                            <label class="checkbox3" for ="competentie24">Hardware interfacing Realiseren</label><br>
                            <input class="invulbox3" type = "checkbox" id="competentie25" name="competentie[]" value="Hardware interfacing Manage & control">
                            <label class="checkbox3" for ="competentie25">Hardware interfacing Manage & control</label><br>
                        </div>
                     </tr>
                     <tr>
                        <td width = "100">studieduur</td>
                        <td><input name = "studieduur" type = "text" 
                           id = "studieduur"></td>
                     </tr>

                     <tr>
                        <td width = "100">rating</td>
                        <td><input name = "rating" type = "text" 
                           id = "rating"></td>
                     </tr>

                     <tr>
                        <td width = "100">bronnen</td>
                        <td><input name = "bronnen" type = "text" 
                           id = "bronnen"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "update" type = "submit" 
                              id = "update" value = "Update">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            <?php
         }
      ?>
      
   </body>
</html>