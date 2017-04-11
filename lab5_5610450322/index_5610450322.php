<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="https://fonts.googleapis.com/css?family=Itim|Pridi|Taviraj|Trirong" rel="stylesheet">
        <!--<link rel="stylesheet" media="screen" href="style.css">-->
        <title>คำขวัญประจำจังหวัด</title>

        <style>
            body {
                background: url(IMG_87385.jpg) no-repeat center fixed;
                background-size: cover;
            }

            div.container {
                padding-left: 185px;
                width: 70%;
                /*border: 1px solid bisque;*/
            }

            header {
                clear: left;
                padding: 1em;
                background: url(yellow.jpg) no-repeat center fixed;
                background-size: cover;
                color: darkblue;
                text-align: center;
                /*width: 1000px;*/
                font-family: 'Pridi', serif;
                font-size: 40px;
                letter-spacing: 3px;
            }
            #contact {
                margin-top: 0px;
                padding: 20px;
                font-family: 'Pridi', serif;
                /*text-align: center;*/
                background: url(back.png);
            }

            #contact label{
                display: inline-block;
                width: 390px;
                text-align: right;
            }

            #contact div{
                font-family: 'Pridi', serif;
                margin-top: 1em;
            }


            #button_submit {
                padding-top: 40px;
                padding-left: 370px;
            }
            h2{
                color: darkblue;
                font-size: 40px;
            }

            p {
                color: darkblue;
                font-size: 26px;
            }

            .slogan {
                text-align: center;
            }

            .error{
                color: red;
                margin-left: 10px;
            }
        </style>
    </head>

    <body>
        <?php
        session_start();
        $nameErr = $lastnameErr = $genderErr = $birthdayErr = $provinceErr = "";
        $name = $lastname = $gender = $birthday = $province = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["firstname"])) {
                $nameErr = "<< โปรดกรอกชื่อ";
            } else {
                $name = test_input($_POST["firstname"]);

                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameErr = "<< โปรดกรอกเป็นตัวหนังสือเท่านั้น";
                }
            }

            if (empty($_POST["lastname"])) {
                $lastnameErr = "<< โปรดกรอกนามสกุล";
            } else {
                $lastname = test_input($_POST["lastname"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
                    $lastnameErr = "<< โปรดกรอกเป็นตัวหนังสือเท่านั้น";
                }
            }

            if (empty($_POST["birthday"])) {
                $birthdayErr = "<< โปรดเลือกวันเกิด";
            } else {
                $birthday = test_input($_POST["birthday"]);
            }


            if (empty($_POST["contact_gender"])) {
                $genderErr = "<< โปรดเลือกเพศ";
            } else {
                $gender = test_input($_POST["contact_gender"]);
            }

            if (isset($_POST["$province"])) {
                $provinceErr = "<< โปรดเลือกจังหวัด";
            } else {
                $province = test_input($_POST["province"]);
                $_SESSION["province"] = $province;
            }

            $birthY = intval(substr($birthday, 0, 4));
            $currentY = intval(date("Y"));
            $age = $currentY - $birthY;

            requestMottoData();
            if ($age < 13) {
                header('Location: child.php');
            } elseif ($gender == "female") {
                header('Location: female.php');
            } elseif ($gender == "male") {
                header('Location: male.php');
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function requestMottoData() {
            global $province;
            $provincefilename = iconv("UTF-8", "windows-874", $province . ".txt");
            $_SESSION["slogan"] = "provinceDetail/motto/" . $provincefilename;
            $_SESSION["picture"] = "provinceDetail/sign/" . $province . ".png";
        }
        ?>

        <div class="container">
            <header class="head">
                <h1>คำขวัญประจำจังหวัด</h1>
            </header>


            <form id="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label for="contact_firstname">ชื่อ &emsp;&emsp;</label>
                    <input type="text" id="contact_firstname" name="firstname" value="<?php echo $name; ?>">
                    <span class="error"><?php echo $nameErr; ?></span>
                </div>
                <div>
                    <label for="contact_lastname">นามสกุล &emsp;&emsp;</label>
                    <input type="text" id="contact_lastname" name="lastname" value="<?php echo $lastname; ?>">
                    <span class="error"><?php echo $lastnameErr; ?></span>
                </div>
                <div>
                    <label for="contact_birthday">วันเกิด &emsp;&emsp;</label>
                    <input type="date" id="contact_birthday" name="birthday" value="<?php echo $birthday; ?>">
                    <span class="error"><?php echo $birthdayErr; ?></span>
                </div>
                <div>
                    <label for="contact_gender">เพศ &emsp;&emsp;</label>
                    <input type="radio" id="male" name="contact_gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male"> ชาย
                    &emsp;&emsp;<input type="radio" id="female" name="contact_gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female"> หญิง
                    <span class="error"><?php echo $genderErr; ?></span>
                </div>
                <div>
                    <label for="contact_province">จังหวัด &emsp;&emsp;</label>
                    <select id="contact_province" name="province" value="<?php echo $province; ?>">
                        <option value="จันทบุรี">จันทบุรี</option>
                        <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                        <option value="ชลบุรี">ชลบุรี</option>
                        <option value="ตราด">ตราด</option>
                        <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                        <option value="ระยอง">ระยอง</option>
                        <option value="สระแก้ว">สระแก้ว</option>
                        <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                        <option value="กำแพงเพชร">กำแพงเพชร</option>
                        <option value="ชัยนาท">ชัยนาท</option>
                        <option value="นครนายก">นครนายก</option>
                        <option value="นครปฐม">นครปฐม</option>
                        <option value="นครสวรรค์">นครสวรรค์</option>
                        <option value="นนทบุรี">นนทบุรี</option>
                        <option value="ปทุมธานี">ปทุมธานี</option>
                        <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                        <option value="พิจิตร">พิจิตร</option>
                        <option value="พิษณุโลก">พิษณุโลก</option>
                        <option value="ลพบุรี">ลพบุรี</option>
                        <option value="สมุทรปราการ">สมุทรปราการ</option>
                        <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                        <option value="สมุทรสาคร">สมุทรสาคร</option>
                        <option value="สระบุรี">สระบุรี</option>
                        <option value="สิงห์บุรี">สิงห์บุรี</option>
                        <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                        <option value="สุโขทัย">สุโขทัย</option>
                        <option value="อุทัยธานี">อุทัยธานี</option>
                        <option value="อ่างทอง">อ่างทอง</option>
                        <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                        <option value="น่าน">น่าน</option>
                        <option value="พะเยา">พะเยา</option>
                        <option value="ลำปาง">ลำปาง</option>
                        <option value="ลำพูน">ลำพูน</option>
                        <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                        <option value="เชียงราย">เชียงราย</option>
                        <option value="เชียงใหม่">เชียงใหม่</option>
                        <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                        <option value="แพร่">แพร่</option>
                        <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                        <option value="ขอนแก่น">ขอนแก่น</option>
                        <option value="ชัยภูมิ">ชัยภูมิ</option>
                        <option value="นครพนม">นครพนม</option>
                        <option value="นครราชสีมา">นครราชสีมา</option>
                        <option value="บึงกาฬ">บึงกาฬ</option>
                        <option value="บุรีรัมย์">บุรีรัมย์</option>
                        <option value="มหาสารคาม">มหาสารคาม</option>
                        <option value="มุกดาหาร">มุกดาหาร</option>
                        <option value="ยโสธร">ยโสธร</option>
                        <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                        <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                        <option value="สกลนคร">สกลนคร</option>
                        <option value="สุรินทร์">สุรินทร์</option>
                        <option value="หนองคาย">หนองคาย</option>
                        <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                        <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                        <option value="อุดรธานี">อุดรธานี</option>
                        <option value="อุบลราชธานี">อุบลราชธานี</option>
                        <option value="เลย">เลย</option>
                        <option value="กระบี่">กระบี่</option>
                        <option value="ชุมพร">ชุมพร</option>
                        <option value="ตรัง">ตรัง</option>
                        <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                        <option value="นราธิวาส">นราธิวาส</option>
                        <option value="ปัตตานี">ปัตตานี</option>
                        <option value="พังงา">พังงา</option>
                        <option value="พัทลุง">พัทลุง</option>
                        <option value="ภูเก็ต">ภูเก็ต</option>
                        <option value="ยะลา">ยะลา</option>
                        <option value="ระนอง">ระนอง</option>
                        <option value="สงขลา">สงขลา</option>
                        <option value="สตูล">สตูล</option>
                        <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                        <option value="กาญจนบุรี">กาญจนบุรี</option>
                        <option value="ตาก">ตาก</option>
                        <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                        <option value="ราชบุรี">ราชบุรี</option>
                        <option value="เพชรบุรี">เพชรบุรี</option>
                    </select>
                    <span class="error"><?php echo $provinceErr; ?></span>
                </div>

                <div id="button_submit">
                    <input type="submit" name="submit" value="Submit">
                    <button type="reset">Cancel</button>
                </div>

                <!--<p id="demo">hoo</p>-->

                <!--                                <div class="slogan">
                                                    <h2 id="provi"></h2>-->
                                                    <!--<img id="provImg" src="provinceDetail/sign/กรุงเทพมหานคร.png" alt="Picture Slogan" style="width:200px;height:200px;text-align:center;">-->
                <!--                                    <p id="sloganText"></p>
                                                </div>-->
            </form>
        </div>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $lastname;
echo "<br>";
echo $birthday;
echo "<br>";
echo $province;
echo "<br>";
echo $gender;
?>
    </body>
</html>
