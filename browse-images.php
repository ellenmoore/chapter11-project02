<?php
require_once('config.php');
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

//handling connection errors
if (mysqli_connect_errno()) {
	die(mysqli_connect_error());
}

//sql statements to query continents from geocontinents table for display
 $contSql = "SELECT ContinentName FROM geocontinents ORDER BY ContinentName asc";
 $contResult = mysqli_query($connection, $contSql);
 //sql statements to query popular countries contained in geocountries table
 //AND travelimagedetail table
 $countriesSql = "SELECT CountryName FROM geocountries
					INNER JOIN travelimagedetails 
					ON geocountries.ISO = travelimagedetails.CountryCodeISO
					GROUP BY ISO ORDER BY CountryName asc";
 $countriesResult = mysqli_query($connection, $countriesSql);
 //sql statements to query cities contained in geocities table
 //AND travelimagedetail table
 $citiesSql = "SELECT AsciiName FROM geocities
					INNER JOIN travelimagedetails 
					ON geocities.CountryCodeISO = travelimagedetails.CountryCodeISO
					GROUP BY geocities.CountryCodeISO ORDER BY AsciiName asc";
 $citiesResult = mysqli_query($connection, $citiesSql);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'includes/travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="#">Home</a></li>
           <li><a href="#">Browse</a></li>
           <li class="active">Images</li>
         </ol>          
    
         <div class="well well-sm">
            <form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="city">
                  <option value="0">Filter by City</option>
						<?php 
						//display the popular city list
						if ($citiesResult = mysqli_query($connection, $citiesSql)) {
							while($row = mysqli_fetch_assoc($citiesResult)){
							echo "<option>" . $row['AsciiName'] . "</option>";
							}
						}
					?>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="country">
                  <option value="ZZZ">Filter by Country</option>
					<?php 
						//display the country list
						if ($countriesResult = mysqli_query($connection, $countriesSql)) {
							while($row = mysqli_fetch_assoc($countriesResult)){
							echo "<option>" . $row['CountryName'] . "</option>";
							}
						}
					?>
                </select>
              </div>  
              <button type="submit" class="btn btn-primary">Filter</button>
            </form>         
         </div>      <!-- end filter well -->
         
         <div class="well">
            <div class="row">
                <!-- display image thumbnails code here -->
            </div>
         </div>   <!-- end images well -->

      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>