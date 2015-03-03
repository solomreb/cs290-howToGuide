<html>
<head>
<style type="text/css" media="screen">
/* You can customize the CSS below if you like*/
.rav_project {
  margin-bottom: 5px;
  width: 77px;
  overflow: hidden;
}
.rav_title {
  font-size: .9em;
}
.rav_bar {
  line-height: 1.3em;
  height: 1.3em;
  text-align: center;
}
.rav_bar_wrapper {
  position: relative;
  background-color: #eee;
  border: 1px solid #aaa;
}
.rav_bar_text {
  text-align: center;
  font-size: 11px;
  position: relative;
}
.rav_bar_fill { 
  position: absolute;
  background-color: rgb(144, 238, 144);
}
.rav_photo {
  display: block;
  margin-top: 5px;
  border: 1px solid #aaa;
  border-bottom: none
}
.rav_photo, .rav_photo img {
  width: 75px;
  height: 75px;
}

.rav_photo_count_, .rav_photo_count_0 {
  display: none;
}

</style>
</head>
<body>
<h1>ravelry1.php</h1>
<script>
  dug({
    cacheExpire: 0,
    endpoint: "http://api.ravelry.com/projects/rebebe/progress.json?key=19250e289e0e4288df7723600a31d060b9addcdf&status=in-progress&notes=false",
    template: '#dugjs-template'
  });

</script>
<?PHP

include 'storedInfo.php';
    // Based on
    // http://stackoverflow.com/questions/7732634/making-a-http-get-request-with-http-basic-authentication
    function get_url($url, $user, $password) {
    	echo "hi";
    	$data = ['type'=> 'project', 'commented_id'=>'1967276', 'body'=>'testing comments'];
        // Create a stream using a get request
        $opts = array(
          'http'=>array(
            'method'=>"POST",
            'header' => "Authorization: Basic " . base64_encode("$user:$password"),                 
          	'content' => http_build_query($data)
          )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        return file_get_contents($url, false, $context);

    }

    function show($value, $response) {
        print("Raw response:<p>$value\n</p>");

        print("Json-decoded repsonse\n");

        // This is from http://php.net/manual/en/function.var-dump.php
        echo '<pre>'; // This is for correct handling of newlines
        ob_start();
        var_dump($response);
        $a=ob_get_contents();
        ob_end_clean();
        echo htmlspecialchars($a,ENT_QUOTES); // Escape every HTML special chars (especially > and < )
        echo '</pre>';
    }

    $apiUrl = 'https://api.ravelry.com';
	$query = $apiUrl . "/comments/create.json";
	//$query = 'http://api.ravelry.com/projects/rebebe/progress.json?key=19250e289e0e4288df7723600a31d060b9addcdf'
	
    $file = get_url($query, $username, $password);
    $response = json_decode($file, true);

    // Display the results
    show($file, $response);

    // Get something interesting from the response
    print("Yarns:'{$response['yarns'][0]['name']}'\n");
    //var_dump($response['yarns'][0]['name']);
    echo "count = " . count($response['yarns']);
    
?>

</body>
</html>
