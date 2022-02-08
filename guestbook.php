<?PHP

function readGuestBook()
{
  $contents = "";
  if(($fp = fopen("guestbook.txt", "r")) === false)
    return false;
  while(!feof($fp)){
    $contents .= fgets($fp) . "<BR>";
  }
  fclose($fp);
  return $contents;
}

function addToGuestBook($imie, $nazwisko, $email, $contents)
{
  if(($fp = @fopen("guestbook.txt", "r")) == false)
    return false;
  $tempC = fread($fp, filesize("guestbook.txt"));
  fclose($fp);
  $fp = fopen("guestbook.txt", "w");
  fputs($fp, $imie."\r\n");
  fputs($fp, $nazwisko."\r\n");
  fputs($fp, $email."\r\n");
  fputs($fp, $contents."\r\n");
  fputs($fp, "\r\n");
  fputs($fp, $tempC);
  fclose($fp);
}

if(isSet($_POST["imie"])){
  $imie = $_POST["imie"];
}
else{
  $imie = "";
}

if(isSet($_POST["nazwisko"])){
  $nazwisko = $_POST["nazwisko"];
}
else{
  $nazwisko = "";
}

if(isSet($_POST["email"])){
  $email = $_POST["email"];
}
else{
  $email = "";
}

if(isSet($_POST["contents"])){
  $contents = $_POST["contents"];
}
else{
  $contents = "";
}

if($imie == "" && $nazwisko == ""
   && $email == "" && $contents == ""){
  echo(readGuestBook());
}
else{
  addToGuestBook($imie, $nazwisko, $email, $contents);
  echo(readGuestBook());
}
?>