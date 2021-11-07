window.onload = function() {
    var httpRequest;

    document.getElementById("lookup").addEventListener("click", function(event) {
        event.preventDefault();

        httpRequest = new XMLHttpRequest();

        var letters_only = /^[a-zA-Z\s]*$/;

        // get search input
        var searchTerm = document.getElementById("country").value.trim();
        
        if (searchTerm == "") {
            var queryStr = "";
        }else{
            // sanitise query
            if (letters_only.test(searchTerm)) {
                var queryStr = "?country=" + searchTerm;
            }
        }

        //request 
        httpRequest.onreadystatechange = searchWorld;
        httpRequest.open("GET", "world.php" + queryStr );
        httpRequest.send();


        function searchWorld(){
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                // Everything is good, the response was received.
                if (httpRequest.status === 200) {
                    // Perfect!
                    document.getElementById("result").innerHTML = httpRequest.responseText;
                    //alert(httpRequest.responseText);
                } else {
                    // There was a problem with the request.
                }
            } else {
                // Not ready yet.
            }
        }
    });

};
