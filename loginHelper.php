<script>
    var username;
    var password;
    function submitForm(){
        document.getElementById('username').value = username;
        document.getElementById('password').value = password;
        document.forms[0].submit();
    }
    function admin() {
        username = "admin";
        password = username;
        submitForm();
    }
    function secretary1() {
        username = "secretary1";
        password = username;
        submitForm();
    }
    function secretary2() {
        username = "secretary2";
        password = username;
        submitForm();
    }
    function professor1() {
        username = "professor1";
        password = username;
        submitForm();
    }
    function professor2() {
        username = "professor2";
        password = username;
        submitForm();
    }
    function professor3() {
        username = "professor3";
        password = username;
        submitForm();
    }
    function student1() {
        username = "student1";
        password = username;
        submitForm();
    }
    function student2() {
        username = "student2";
        password = username;
        submitForm();
    }
    function student3() {
        username = "student3";
        password = username;
        submitForm();
    }
    function student4() {
        username = "student4";
        password = username;
        submitForm();
    }
    function student5() {
        username = "student5";
        password = username;
        submitForm();
    }
    function student6() {
        username = "student6";
        password = username;
        submitForm();
    }

</script>
<h4> Quick login as:</h4>
<table align="center">
    <tr>
        <td><button class="warningButton" onclick="admin()">admin</button></td>
        <td><button class="lowWarningButton" onclick="secretary1()">secretary1</button></td>
        <td><button class="lowWarningButton" onclick="secretary2()">secretary2</button></td>
        <td><button class="infoButton" onclick="professor1()">professor1</button></td>
        <td><button class="infoButton" onclick="professor2()">professor2</button></td>
        <td><button class="infoButton" onclick="professor3()">professor3</button></td>
    </tr>
    <tr>
        <td><button onclick="student1()">student1</button></td>
        <td><button onclick="student2()">student2</button></td>
        <td><button onclick="student3()">student3</button></td>
        <td><button onclick="student4()">student4</button></td>
        <td><button onclick="student5()">student5</button></td>
        <td><button onclick="student6()">student6</button></td>
    </tr>
</table>


