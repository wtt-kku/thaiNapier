<?php 
session_start();

if($_POST){
    require_once("database/connect.php");
    $farmName = $_POST["farmName"];
    $farmType = $_POST["farmType"];
    $Rai = $_POST["Rai"]; 
    $Ngan = $_POST["Ngan"];
    $squareMeter = $_POST["squareMeter"];
    // $Area = $Rai + ($Ngan/4) + ($squareMeter/400);
    $farmArea = $Rai."-".$Ngan."-".$squareMeter;
    // $allArea = number_format($Area, 2, '.', '');

    

    $houseNo = $_POST["houseNo"];
    
    $villageNo = $_POST["villageNo"]; 
    $village = $_POST["village"]; 
    $alley = $_POST["alley"];
    $road = $_POST["road"]; 
    $postNo = $_POST["postNo"]; 
    $Subdistrict = $_POST["sub-District"];
    $district = $_POST["district"]; 
    $province = $_POST["province"];
    $loginId = $_SESSION['Id'];

    $address = "บ้านเลขที่ ".$houseNo." หมู่ ".$villageNo." หมู่บ้าน".$village." ซอย".$alley." ถนน".$road." ตำบล"
              .$Subdistrict." อำเภอ".$district." จังหวัด".$province." ".$postNo;

    $lat = $_POST["input-lat"];
    $lng = $_POST["input-lng"];

    

    $sql = "INSERT INTO tb_registers (loginId,farmName,farmType,farmArea,farmHouseNo,farmVillageNo,farmVillage,farmAlley,farmRoad,farmPostNo,farmSubDistric,farmDistrict,farmProvince,lat,lng)
    VALUES('".$loginId."','".$farmName."','".$farmType."','".$farmArea."','".$houseNo."','".$villageNo."','".$village."','".$alley."','".$road."','".$postNo."','".$Subdistrict."','".$district."','".$province."','".$lat."','".$lng."')";
    $query = mysqli_query($link,$sql);
    mysqli_close($link);
    header("location:farmlist.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THAINAPIER เว็บไทยเนเปียร์</title>
    <link rel="icon" href="img/iconweb.ico" type="image/ico">
    <script src= "https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/webstyle.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/bb7f694074.js"></script>


</head>
<body>

<?php
//include("header.php"); 
?>

<header>
        <nav>
       
        <div class="header"></div>

          <!-- <input type="checkbox" id="check">
              <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
              </label>   -->
              <input type="checkbox" id="openmenu" class="hamburger-checkbox">
              <div class="hamburger-icon checkbtn">
                <label for="openmenu" id="hamburger-label">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                </label>    
              </div>


              <input type="checkbox" id="check2">
              <label for="check2" class="checkbtn2">
                <i class="fas fa-user-circle"></i>
              </label>  
          

      
            <img src="img/logo_napier3.png" alt="logo" ></img>
            <ul class="all-mainmenu">
              <li><a href="index.php" >ข้อมูลหญ้าเนเปียร์</a></li>
              <li><a href="planting.php">การเพาะปลูก</a></li>
              <li><a href="research.php">การทดลอง</a></li>
              <?php if($_SESSION['Level']=="admin"){ ?>
                          <li><a href="dashboard.php" >สถิติข้อมูลการเกษตร</a></li>
              <?php }else{ ?>
                          <li><a href="#" id="btn-reg" class="active" >ลงทะเบียนเกษตรกร</a></li>    
             <?php } ?> 
             <li><a href="../../" >เว็บไซต์หลัก</a></li>
            </ul>
            
            <div id="user-control" class="user-control">
              <ul class="user-menu">
                <!-- ยังไม่ล็อกอิน --> 
                <?php 
                if($_SESSION['Level']==""){
                ?>          
                <li><a href="sign_in.php"><i class="fas fa-edit"></i> ลงชื่อเข้าใช้</a></li>
                <li><a href="sign_up.php"><i class="fas fa-user-plus"></i> สมัครสมาชิก</a></li>
                <?php
                }
                else if($_SESSION['Level']=="admin"){ ?>

                  <li><a href="#"><i class="fas fa-user"></i> ชื่อผู้ใช้ : <?php echo $_SESSION['Username']; ?></a></li>
                  <li><a href="#"> </a></li> 
                  <li><a href="manage_members.php">จัดการสมาชิก</a></li>
                  <input type="hidden" id="btn-reg"> <!-- JS ERROR -->
                  <?php
                }
                else if($_SESSION['Level']=="member"){ ?>

                  <li><a href="#"><i class="fas fa-user"></i> ชื่อผู้ใช้ : <?php echo $_SESSION['Username']; ?></a></li>
                  <li><a href="#"> </a></li> 
                  <li><a href="farmlist.php">รายการลงทะเบียน</a></li>
                  <?php
                }
                ?>
                <?php 
                if($_SESSION['Level']!=""){
                ?>   
                <li><a href="#" id="btn-signout" onclick="signout()">ออกจากระบบ</a></li>
                <?php } ?>
                
                
       
                <!-- ล็อกอินแล้ว -->
               

              </ul>
            </div>
        </nav>
        
  </header>


<a href="javascript:" id="return-to-top" onclick="topFunction()" style="display: none;z-index: 4;"><i class="fas fa-chevron-up"></i></a>

<section class="content bg-gray"><br>
    

    
        
<?php if(!$_SESSION['Level']){ ?>
    <div class="header-form">403 Forbidden </div>
    <div class="warning-login"><p>สิทธิ์ไม่ถูกต้อง กรุณาเข้าสู่ระบบก่อนใช้งาน</p></div>
<?php }else{ ?>
    <div class="header-form">ลงทะเบียนเกษตรกร </div>
    <form id="register" method="post" action="regis_farm.php">
    <div class="form-reg">
        <div class="content">
            <div class="title">กรอกข้อมูลทั่วไป</div>

            <div class="content1row">
                <div class="content1row-1">
                    <div class="title-input">ชื่อไร่ <div class="requiredmark">*</div></div>
                    <input type="text" id="farmName"  name="farmName" placeholder="ชื่อไร่เกษตร" required> 
                </div>
            </div>

            <div class="content1row">
                <div class="content1row-1">
                    <div class="title-input pdz">ประเภท <div class="requiredmark">*</div></div>

                    <label class="content1row-e"> เกษตรกรรายย่อย
                        <input type="radio" checked name="farmType" value="small">
                        <span class="checkmark"></span>
                    </label>
                    <label class="content1row-e"> เกษตรกรรายใหญ่
                        <input type="radio" name="farmType" value="large">
                        <span class="checkmark" ></span></label>

                </div>
            </div>

            <div class="content2row">
                <div class="content2row-1">
                    <div class="title-input">เลขที่ <div class="requiredmark">*</div></div>
                    <input type="text" id="houseNo" name="houseNo" placeholder="เลขที่" > 
                </div>
                <div class="content2row-2">
                    <div class="title-input">หมู่ที่</div>
                    <input type="text" id="villageNo" name="villageNo" placeholder="หมู่ที่" > 
                </div>
            </div>

            <div class="content2row">
                <div class="content2row-1">
                    <div class="title-input">หมู่บ้าน/อาคาร/ชั้น</div>
                    <input type="text" id="village" name="village"  placeholder="หมู่บ้าน/อาคาร/ชั้น" > 
                </div>
                <div class="content2row-2">
                    <div class="title-input">ตรอก/ซอย</div>
                    <input type="text" id="alley" name="alley" placeholder="ตรอก/ซอย" > 
                </div>
            </div>


            <div class="content1row">
                <div class="content1row-1">
                    <div class="title-input">ถนน</div>
                    <input type="text" id="road" name="road" placeholder="ถนน" > 
                </div>
            </div>

            <div class="content2row">
                <div class="content2row-1">
                    <div class="title-input">รหัสไปรษณีย์ <div class="requiredmark">*</div></div>
                    <input type="text" id="postNo" name="postNo" placeholder="รหัสไปรษณีย์" > 
                </div>
                <div class="content2row-2">
                    <div class="title-input">ตำบล/แขวง <div class="requiredmark">*</div></div>
                    <input type="text" id="sub-District" name="sub-District" placeholder="ตำบล/แขวง" > 
                </div>
            </div>

            <div class="content2row">
                <div class="content2row-1">
                    <div class="title-input">อำเภอ/เขต <div class="requiredmark">*</div></div>
                    <input type="text"  id="district" name="district" placeholder="อำเภอ/เขต" > 
                </div>
                <div class="content2row-2">
                    <div class="title-input">จังหวัด<div class="requiredmark">*</div></div>
                    <!-- <input type="text"  id="province" name="province" placeholder="จังหวัด" >  -->
                    <select  id="province" name="province" require>
                    <option value="" selected>== จังหวัด ==</option>
                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                    <option value="กระบี่">กระบี่ </option>
                    <option value="กาญจนบุรี">กาญจนบุรี </option>
                    <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                    <option value="กำแพงเพชร">กำแพงเพชร </option>
                    <option value="ขอนแก่น">ขอนแก่น</option>
                    <option value="จันทบุรี">จันทบุรี</option>
                    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                    <option value="ชัยนาท">ชัยนาท </option>
                    <option value="ชัยภูมิ">ชัยภูมิ </option>
                    <option value="ชุมพร">ชุมพร </option>
                    <option value="ชลบุรี">ชลบุรี </option>
                    <option value="เชียงใหม่">เชียงใหม่ </option>
                    <option value="เชียงราย">เชียงราย </option>
                    <option value="ตรัง">ตรัง </option>
                    <option value="ตราด">ตราด </option>
                    <option value="ตาก">ตาก </option>
                    <option value="นครนายก">นครนายก </option>
                    <option value="นครปฐม">นครปฐม </option>
                    <option value="นครพนม">นครพนม </option>
                    <option value="นครราชสีมา">นครราชสีมา </option>
                    <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                    <option value="นครสวรรค์">นครสวรรค์ </option>
                    <option value="นราธิวาส">นราธิวาส </option>
                    <option value="น่าน">น่าน </option>
                    <option value="นนทบุรี">นนทบุรี </option>
                    <option value="บึงกาฬ">บึงกาฬ</option>
                    <option value="บุรีรัมย์">บุรีรัมย์</option>
                    <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                    <option value="ปทุมธานี">ปทุมธานี </option>
                    <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                    <option value="ปัตตานี">ปัตตานี </option>
                    <option value="พะเยา">พะเยา </option>
                    <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                    <option value="พังงา">พังงา </option>
                    <option value="พิจิตร">พิจิตร </option>
                    <option value="พิษณุโลก">พิษณุโลก </option>
                    <option value="เพชรบุรี">เพชรบุรี </option>
                    <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                    <option value="แพร่">แพร่ </option>
                    <option value="พัทลุง">พัทลุง </option>
                    <option value="ภูเก็ต">ภูเก็ต </option>
                    <option value="มหาสารคาม">มหาสารคาม </option>
                    <option value="มุกดาหาร">มุกดาหาร </option>
                    <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                    <option value="ยโสธร">ยโสธร </option>
                    <option value="ยะลา">ยะลา </option>
                    <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                    <option value="ระนอง">ระนอง </option>
                    <option value="ระยอง">ระยอง </option>
                    <option value="ราชบุรี">ราชบุรี</option>
                    <option value="ลพบุรี">ลพบุรี </option>
                    <option value="ลำปาง">ลำปาง </option>
                    <option value="ลำพูน">ลำพูน </option>
                    <option value="เลย">เลย </option>
                    <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                    <option value="สกลนคร">สกลนคร</option>
                    <option value="สงขลา">สงขลา </option>
                    <option value="สมุทรสาคร">สมุทรสาคร </option>
                    <option value="สมุทรปราการ">สมุทรปราการ </option>
                    <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                    <option value="สระแก้ว">สระแก้ว </option>
                    <option value="สระบุรี">สระบุรี </option>
                    <option value="สิงห์บุรี">สิงห์บุรี </option>
                    <option value="สุโขทัย">สุโขทัย </option>
                    <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                    <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                    <option value="สุรินทร์">สุรินทร์ </option>
                    <option value="สตูล">สตูล </option>
                    <option value="หนองคาย">หนองคาย </option>
                    <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                    <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                    <option value="อุดรธานี">อุดรธานี </option>
                    <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                    <option value="อุทัยธานี">อุทัยธานี </option>
                    <option value="อุบลราชธานี">อุบลราชธานี</option>
                    <option value="อ่างทอง">อ่างทอง </option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
                </div>
            </div>

            <div class="title">จำนวนพื้นที่ที่ทำการเกษตร<div class="requiredmark">*</div></div>
            
            <div class="content1row">
                <div class="content1row-ex">
                <input type="number" id="Rai" name="Rai" placeholder="จำนวนไร่" min="0" value="0"><p> ไร่ <p/>
                <input type="number" id="Ngan" name="Ngan" placeholder="จำนวนงาน"  min="0" max="3" value="0" ><p> งาน <p/>
                <input type="number" id="squareMeter" name="squareMeter" placeholder="จำนวนตารางวา" min="0" max="99" value="0" ><p> ตารางวา <p/>
                </div>
            </div><br><br><br>

            <div class="title">พิกัดพื้นที่ทำการเกษตร<div class="requiredmark">*</div></div>
            <input type="hidden" id="input-lat" name="input-lat" style="width: 300px;"><br>
            <input type="hidden" id="input-lng" name="input-lng" style="width: 300px;">
            <div class="map">
                <div class="search-box">
                    <input type="text" id="search" name="search" placeholder="ค้นหาด้วยชื่ออำเภอ/จังหวัด">
                    <button type="button" id="find">ค้นหา</button><br>
                </div>
                <div class="map-content">
                    <div id="map"></div>
                </div>
                <div class="position-selected">
                    พิกัดที่คุณเลือก : <p name="ll" id="ll">-</p>
                </div>
            
            </div>

            <div class="btn-submit">
                <input type="button"  value="ยืนยันการลงทะเบียน" onclick="check()">
            </div>

        
        
        </div>
        <?php }?> 
    </div>

    </form>

</section>
  

 <?php
include("footer.php"); 
  ?>

<script type="text/javascript" src="js/sweet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCupYjugVXX0hveSzf_PG8ESMvBstFgNXI&callback=initMap" async defer></script>
<script src="js/map-api.js"></script>
<script src="js/event.js"></script>
<script type="text/javascript" src="js/sweet.js"></script>
<script>
    function check() {
      var status = 0;
      if(document.getElementById("farmName").value == "" ||
          document.getElementById("houseNo").value == "" ||
          document.getElementById("postNo").value == "" ||
          document.getElementById("sub-District").value == "" ||
          document.getElementById("district").value == "" ||
          document.getElementById("province").value == "" ||
          document.getElementById("Rai").value == "" ||
          document.getElementById("Ngan").value == "" ||
          document.getElementById("input-lat").value == "" ||
          document.getElementById("input-lng").value == "" ||
          document.getElementById("squareMeter").value == "")
        {
          status = 1;
        } 

      if(status == 0){
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ลงทะเบียนสำเร็จ',
            showConfirmButton: false,
            timer: 5000
            });
            setTimeout(function(){
                document.getElementById("register").submit();
            },2500);
            
      }else {
            Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'ข้อมูลไม่ครบ',
            text: 'กรุณากรอกข้อมูลให้ครบ',
            showConfirmButton: false,
            timer: 2000
            });
      }
    }
  </script>

 

</body>
</html>