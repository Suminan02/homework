<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Jersey+10&display=swap" rel="stylesheet">
    <style>
        table {
            font-family: "Jersey 10", serif;
            font-size: large;
            border-collapse: collapse;
            width: 100%;
            padding: 5px 5px 5px 5px;
            }
        .info_right{
            text-align: right;
        }
        
        .div1{
            width: 25%;
            background-color: pink;
            margin: auto;
            padding: 5px 0px 5px 0px;
            box-shadow: 5px 10px red;
            
        }
        .div_button{
            text-align: center;
        }
        h3{
            font-family: "Jersey 10", serif;
            font-size: xx-large;
            text-align: center;
            margin: 10px 10px 10px 10px;
        }
        input,textarea{
            border: none;
            margin-bottom: 10px;
            margin-left: 5px;
            border-radius: 3px;
        }
        .button{
            text-align: right;
        }
        button{
            font-family: "Jersey 10", serif;
            font-size: xx-large;
            text-align: center;
        }
        #wornning{
            color: red;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="div1">
        <h3> Register </h3>
        <table>
            <tr>
                <td class="info_right">Username</td>
                <td>
                    <input type="username" name="username" id="username" placeholder="please enter username">
                    <span style= "color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right" >Password</td>
                <td>
                    <input type="password" name="password" id="password" placeholder="please enter your password " >
                    <span style="color:red">*</span>
                </td>
                
            </tr>
            <tr>
                <td class="info_right">Confirm Password</td>
                <td>
                    <input type="password" name="c_password" id="c_password" placeholder="please enter confirm password ">
                    <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right">Name</td>
                <td>
                    <input type="text" name="name" id="name" placeholder="please enter your name ">
                    <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right">Last Name</td>
                <td>
                    <input type="text" name="lastname" id="lastname" placeholder="please enter your last name ">
                    <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right">Email</td>
                <td>
                    <input type="text" name="email" id="email" placeholder="please enter your email ">
                    <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right">Citizen Id</td>
                <td>
                    <input type="number" name="cid" id="cid" placeholder="please enter citizen id">
                    <span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td class="info_right">Phone number</td>
                <td><input type="number" name="phone" id="phone" placeholder="please enter your phone number "></td>
            </tr>
            <tr>
            <td class="info_right">Address</td>
            <td><textarea type="text" name="address" id="address" placeholder="please enter your address "></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td class="div_button"><button id="btn">Submit</button></td>
            </tr>
            <tr>
                <td></td>
                <td><span id="wornning">&nbsp;</span></td>
            </tr>
            </table>
        
    </div>

    <script>
        $( document ).ready(function() {
        console.log( "ready!" );
        });

        $("#btn").click(function(){
            var username = $("#username").val();
            var password = $("#password").val();
            var c_password=$("#c_password").val();
            var name = $("#name").val();
            var lastname =$("#lastname").val();
            var email=$("#email").val();
            var cid=$("#cid").val();
            var phone=$("#phone").val();
            var address=$("#address").val();

        if(username==""){
            valid_data("username","please enter your username!");
            return false;
        }
        if(!/^[a-zA-Z0-9_]{6,16}$/.test(username)){
        valid_data("username","username must have 6-16 dijig and A-Z ,a-z,0-9");
        return false;
        }
        if(password==""){
            valid_data("password","please enter your password!");
            return false;
        }
        if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)){
        valid_data("password","password mush have at lease 8 dijig and 1 special, capital, small and number character ");
        return false;
        }
        if(password==username){
            valid_data("password","passwrod and username are same!");
            return false;
        }
        if(c_password==""){
            valid_data("c_password","please enter your confirm password!");
            return false;
        }
        if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(c_password)){
        valid_data("c_password","Pattern password is wrong!");
        return false;
        }
        if(c_password!==password){
            valid_data("c_password","passwrod and confirm password not same!");
            return false;
        }
        if(name==""){
            valid_data("name","please enter your name!");
            return false;
        }
        if(!/^\p{L}+$/u.test(name)){
        valid_data("name","Pattern name is wrong! or name cannot use special character on number");
        return false;
        }
        if(lastname==""){
            valid_data("lastname","please enter your lastname!");
            return false;
        }
        if(!/^\p{L}+$/u.test(lastname)){
        valid_data("lastname","Pattern lastname is wrong! or Last name cannot use special character on number");
        return false;
        }
        if(email==""){
            valid_data("email","please enter your email!");
            return false;
        }
        if(!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)){
        valid_data("email","Pattern email id is wrong! example email example@abc.com");
        return false;
        }
        if(cid==""){
          valid_data("cid","please enter your citizen id!");
            return false;
        }
        if(cid.length!=13){
          valid_data("cid","citizen ID must have 13 digits! or can use only number");
            return false;
        }
        if(!/^[0-9]+.{12,}$/.test(cid)){
        valid_data("cid","Pattern citizen id is wrong!");
        return false;
        }
        $("#wornning").html("");
        
        var dataString = 
        'username='+ username+
        "&password="+password+
        '&c_password='+c_password+
        '&name='+name+
        '&lastname='+lastname+
        '&email='+email+
        '&cid='+cid+
        '&phone='+phone+
        '&address='+address; //ค่าที่จะส่งไปพร้อมตัวแปร

         //console.log(dataString);

        $.ajax ({
                    type: "POST", //METHOD "GET","POST"
                    url: "tableprocess.php", //File ที่ส่งค่าไปหา
                    data: dataString,
                    //cache: false,
                    success: function(data) {
                        //console.log(data);
                        var data_res=JSON.parse(data);
                        console.log(data_res);
                        if(data_res.ret_code==101){
                            
                        }else{
                            $("#wornning").html(data_res.msg);
                        }
                    } 
                });
        } 

    )  
        function valid_data(elm_id,msg_wron){
            
            $("#wornning").html(msg_wron);
            $("#"+elm_id).focus();
        }
    </script>

</body>
</html>

