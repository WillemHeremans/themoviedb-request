<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
	button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}

.affiche {

display:inline-block;
margin:auto;
animation-name: fromRight;
animation-timing-function: ease-in-out;
animation-duration: 1.5s;

}

@keyframes fromRight {
    from {margin-top: -500px;}
    to {margin-top: 0px;}
}
	
	</style>
  <title>Recherche via The movie db</title>
</head>
<?php

if (!isset($_GET) || empty($_GET))

{

echo '

<header>

<form class="form-wrapper cf" action="" method="get">

       
	<input type="hidden" name="language" value="fr-FR">
      <input type="hidden" name="api_key" value="#">
      
    
      <button type="submit">Cliquez ici pour lancer une recherche</button>

  </form>
    
</header>




';

}


else {

if (isset($_GET['Action'])) {

$genre = "https://api.themoviedb.org/3/genre/28/movies?";

}

else if (isset($_GET['Comédie'])) {

$genre = "https://api.themoviedb.org/3/genre/35/movies?";

}

else if (isset($_GET['Drame'])) {

$genre = "https://api.themoviedb.org/3/genre/18/movies?";

}

else if (isset($_GET['Horreur'])) {

$genre = "https://api.themoviedb.org/3/genre/27/movies?";

}

else {
$genre = "https://api.themoviedb.org/3/genre/35/movies?";
}



$uri = $_SERVER['REQUEST_URI'];

$myurl = parse_url($uri);

$url = $genre.$myurl["query"]; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$characters = json_decode($data); // decode the JSON feed

	echo '<header style="position:relative;">
    <a href="?Action&language=fr-FR&api_key=#"><button style="width:25%;">Action</button></a><a href="?Comédie&language=fr-FR&api_key=#"><button style="width:25%;">Comédie</button></a><a href="?Drame&language=fr-FR&api_key=#"><button style="width:25%;">Drame</button></a><a href="?Horreur&language=fr-FR&api_key=#"><button style="width:25%;">Horreur</button></a>
</header>';

		$comb = count($characters->results) -1;

		for ($numb = 0; $numb <= $comb; $numb++) {


		$title = $characters->results[$numb]->title;
			
	echo '
	<div class="affiche">
	<br />
	<p style="text-align:center;margin: auto;"><img style="max-width:300px;" src="http://image.tmdb.org/t/p/w500/'.$characters->results[$numb]->poster_path.'" alt="Loading..." title="'.$title.' **** '.$characters->results[$numb]->overview.'"><br /></p>
	<br />
	
	</div>';
	
	
		
			}
	
#		echo '<p style="text-align:center;"> <a href="./endpoint-global-search.php?'.$myurl["query"]. '&page=2">Page suivante</a></p>';
	
}
?>
