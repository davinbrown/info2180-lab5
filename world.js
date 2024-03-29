window.onload = function() {

    document.getElementById("lookup").addEventListener("click", lookupWorld);
    document.getElementById("lookup_cites").addEventListener("click", lookupCites);
    
    function lookupWorld(event) {
        event.preventDefault();
        $searchTerm = getInput();
        $query = "?country=" + $searchTerm;
        sendGetRequest($query);  //send request
    }

    function lookupCites(event) {
        event.preventDefault();
        $searchTerm = getInput();
        $query = "?country=" + $searchTerm + "&context=cities";
        sendGetRequest($query); //send request
    }

    function getInput() {
        var letters_only = /^[a-zA-Z\s]*$/;
        // get search input
        var searchTerm = document.getElementById("country").value.trim();
        if (letters_only.test(searchTerm)) {
            return searchTerm;
        }else{
            return false;
        }
    }

    function sendGetRequest(queryStr) {
        
        var httpRequest;
        httpRequest = new XMLHttpRequest();
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

    }
};