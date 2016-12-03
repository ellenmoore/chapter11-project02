         <div class="panel panel-default">
           <div class="panel-heading">Search</div>
           <div class="panel-body">
             <form>
               <div class="input-group">
                  <input type="text" class="form-control" placeholder="search ...">
                  <span class="input-group-btn">
                    <button class="btn btn-warning" type="button"><span class="glyphicon glyphicon-search"></span>          
                    </button>
                  </span>
               </div>  
             </form>
           </div>
         </div>  <!-- end search panel -->       
      
         <div class="panel panel-info">
           <div class="panel-heading">Continents</div>
           <ul class="list-group">   
					<?php 
						//display the continent links
						if ($contResult = mysqli_query($connection, $contSql)) {
							while($row = mysqli_fetch_assoc($contResult)){
							//echo "<li>";					
							echo "<a href='#'>";
							echo $row['ContinentName'];
							echo "</a><br/>";
							}
						}
					?>

           </ul>
         </div>  <!-- end continents panel -->  
         <div class="panel panel-info">
           <div class="panel-heading">Popular Countries</div>
           <ul class="list-group">  
					<?php 
						//display the popular country links
						if ($countriesResult = mysqli_query($connection, $countriesSql)) {
							while($row = mysqli_fetch_assoc($countriesResult)){
							//echo "<li>";					
							echo "<a href='#'>";
							echo $row['CountryName'];
							echo "</a><br/>";
							}
						}
					?>
  
           </ul>
         </div>  <!-- end countries panel -->    