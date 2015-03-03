<html>
<body>
<h1>test.php</h1>

<?PHP
    // Based on
    // http://stackoverflow.com/questions/7732634/making-a-http-get-request-with-http-basic-authentication
    function get_url($url, $user, $password) {
    $data=array(type=>project, commented_id=>'1967047', body=>'Cool hat!');
        $opts = array(
          'http'=>array(
            'method'=>"POST",
            'header' => "Authorization: Basic " . base64_encode("$user:$password") ,
            'content' => http_build_query($data)               
          )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $file = file_get_contents($url, false, $context);
        $response = json_decode($file, true);
        return $response;

    }
    

 //1967047
    function show($response) {

        print("Json-decoded repsonse\n");

        // This is from //http://php.net/manual/en/function.var-dump.php
        echo '<pre>'; // This is for correct handling of newlines
        ob_start();
        var_dump($response);
        $a=ob_get_contents();
        ob_end_clean();
        echo htmlspecialchars($a,ENT_QUOTES); // Escape every HTML special chars (especially > and < )
        echo '</pre>';
    }

    $url = 'https://api.ravelry.com/comments/create.json';
    $username = '6750A80E8ADD957C84EF';
    $password = 'Mn7REoBRdZjqi52NtAKnfaQ1uE_XPfhWAgN0CQ3e';

	$response= get_url($url, $username, $password);
    show($response);
    



?>

</body>
</html>
