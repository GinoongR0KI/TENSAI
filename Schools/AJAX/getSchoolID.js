function getUserSchoolID(uType, targetInput) {
    var request = new XMLHttpRequest();

    request.open("POST", "");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            if (result != "" && result != null) {
                var ids = JSON.parse(result);

                // Get the data to the needed inputs
                targetInput.value = ids[0]['id'];
            }
        }
    };

    request.send("uType="+uType);
}