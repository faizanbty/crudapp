<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title>
    <script src="jquery-1.8.2.js"></script>
    <script src="jquery-1.8.2.min.js"></script>
</head>

<script>
    var employeelist = [];
    var i = 0;


    // SEARCH FORM SHOW BUTTON
    function search() {

        $("#main").show();
        $("#addrec").hide();
        $("#editrec").hide();
    }


    // ADD RECORD FORM FUNCTION
    function addRec() {

        $("#addrec").show();
        $("#main").hide();
        $("#editrec").hide();
    }


    // SHOW RECORD FUNCTION
    function showRec() {

        $("#addrec").hide();
        $("#grid").show()
        $("#editrec").hide();

        var mtable = document.getElementById("mtable");
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;

        mtable.innerHTML = "";

        // JSON DATA
        var employee = {
            "name": name,
            "email": email,
        };

        // CONVERTING JSON TO STRING
        var emp = JSON.stringify(employee);


        var url_input_customer = {
            url: "http://localhost/Ajax/inputCustomer.php",
            contentType: "application/json",
            dataType: "json",
            data: {
                emp
            },
            method: "GET"
        }

        //    GET DATA FROM DATABASE
        $.ajax(url_input_customer).done(function(data, status) {
            if (status == "success") {
                if (data.length > 0) {
                    employeelist = data
                    for (var i = 0; i <= data.length; i++) {
                        mtable.innerHTML += "<tr><td>" + data[i].customerName + "</td><td>" + data[i].email + "</td><td>" + data[i].phone + "</td><td>" + data[i].addressLine1 + "</td><td><input type='button' onclick='editRec(" + i + ")' value='Edit'></td><td><input type='button' onclick='deleteRec(" + i + ")' value='Delete'></td></tr>";
                    }

                } else {
                    alert("No data exist");
                }
            }
        }).fail(function() {
            alert("Authentication Error");
        });
    }

    // END



    // ADD RECORD TO DATABASE
    function save() {

        var cname = document.getElementById("cname").value;
        var cemail = document.getElementById("cemail").value;
        var cpwd = document.getElementById("cpwd").value;
        var msg = document.getElementById("msg");

        // JSON DATA
        var employee = {
            "name": cname,
            "email": cemail,
            "pwd": cpwd
        };


        // CONVERTING JSON TO STRING
        var emp = JSON.stringify(employee);

        var url_add = {
            url: "http://localhost/Ajax/addCustomer.php",
            contentType: "application/json",
            dataType: "json",
            data: {
                emp
            },
            method: "POST"
        }

        //    ADD DATA TO DATABASE
        $.ajax(url_add).done(function(data, status) {
            if (status == "success") {
                msg.innerHTML = "Your Record has been saved";
            } else {
                msg.innerHTML = "Your Record has not been saved";
            }
        }).fail(function() {
            alert("Authentication Error");
        });

    }
    // END


    // EDIT RECORD FORM
    function editRec(id) {
        $("#main").hide();
        $("#addrec").hide();
        $("#editrec").show();

        var eid = document.getElementById("eid");
        var ename = document.getElementById("ename");
        var eemail = document.getElementById("eemail");
        var epwd = document.getElementById("epwd");

        eid.value = employeelist[id].customerNumber;
        ename.value = employeelist[id].customerName;
        eemail.value = employeelist[id].email;
        epwd.value = employeelist[id].pwd;


    }

    function updateRecord() {

        var mid = document.getElementById("eid");
        var ename = document.getElementById("ename");
        var eemail = document.getElementById("eemail");
        var epwd = document.getElementById("epwd");

        var employee = {
            "mid": mid.value,
            "name": ename.value,
            "email": eemail.value,
            "pwd": epwd.value
        };


        var emp = JSON.stringify(employee);



        //    UPDATE DATA TO DATABASE
        $.ajax({
            url: "http://localhost/Ajax/updateCustomer.php",
            contentType: "application/json",
            dataType: "json",
            data: {
                emp
            },
            method: "POST"
        }).done(function(data, status) {
            if (status == "success") {
                alert("Your Record has been updated");
            } else {
                alert("Your Record has not been updated");
            }
        }).fail(function() {
            alert("Authentication Error");
        });
    }

    // DELETE A RECORD

    function deleteRec(id) {

        var mid = document.getElementById("eid");
        eid.value = employeelist[id].customerNumber;
        var employee = {
            "mid": mid.value,
        };

        var emp = JSON.stringify(employee);

        //    DELETE DATA FROM DATABASE
        $.ajax({
            url: "http://localhost/Ajax/deleteCustomer.php",
            contentType: "application/json",
            dataType: "json",
            data: {
                emp
            },
            method: "DELETE"
        }).done(function(data, status) {
            if (status == "success") {
                alert("Your Record has been Deleted");
            } else {
                alert("Your Record has not been Deleted");
            }
        }).fail(function() {
            alert("Authentication Error");
        });

    }

    // END
</script>

<body>


    <!-- BUTTONS -->

    <!-- SEARCH BAR FORM SHOW BUTTON -->
    <input type="button" value="Search" onclick=search()>
    <!-- ADD FORM BUTTON -->
    <input type="button" value="Add Record" onclick=addRec()>



    <!-- SEARCH FORM -->
    <div id="main" style="display: none">
        <table>
            <tr>
                <td>Enter Name</td>
                <td> <input type="text" id="name"></td>
            </tr>
            <tr>
                <td>Enter Email</td>
                <td> <input type="text" id="email"></td>
            </tr>


            <!-- SHOW RECORD BUTTON -->
            <tr>
                <td></td>
                <td><input type="button" value="Show Record" onclick=showRec()></td>
            </tr>
        </table>

        <!-- DATA TABLE -->
        <div id="grid" style="display: none">
            <table id="mtable">
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                </tr>
            </table>
        </div>
    </div>




    <!-- ADD RECORD FORM -->
    <div id="addrec" style="display: none;">
        <table>
            <tr>
                <td><span id="cid"></span></td>
                <td><span id="msg"></span></td>
            </tr>
            <tr>
                <td>Enter Name</td>
                <td><input type="text" id="cname"></td>
            </tr>
            <tr>
                <td>Enter Email</td>
                <td><input type="email" id="cemail"></td>
            </tr>
            <tr>
                <td>Enter Password</td>
                <td><input type="password" id="cpwd"></td>
            </tr>


            <!-- SAVE RECORD BUTTON -->
            <tr>
                <td></td>
                <td><input type="button" value="Save Record" onclick="save()"></td>
            </tr>
        </table>

    </div>

    <!-- EDIT RECORD FORM -->
    <div id="editrec" style="display: none;">
        <table>
            <tr>
                <td><span id="mid"></span></td>
                <td><span id="msg"></span></td>
            </tr>
            <tr>
                <td>ID</td>
                <td><input type="text" id="eid"></td>
            </tr>
            <tr>
                <td>Enter Name</td>
                <td><input type="text" id="ename"></td>
            </tr>
            <tr>
                <td>Enter Email</td>
                <td><input type="email" id="eemail"></td>
            </tr>
            <tr>
                <td>Enter Password</td>
                <td><input type="password" id="epwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="Update Record" onclick="updateRecord()"></td>
            </tr>
        </table>
    </div>


</body>

</html>