<html>


<body>

    <nav class="nav-bar">
        <ul>
            <li><a href="../student-home/student-home.php">HOME</a></li>
            <li><a href="#">YOUR APPLICATIONS</a>
                <ul>
                    <li><a href=" ">View</a></li>
                    <li><a id="showcourse">Cancel</a></li>
                </ul>
            </li>
            <!-- <li><a href="#">APPLICATION</a>
                <ul>
                    <li><a href=" ">Pending</a></li>
                    <li><a href="">Approved</a></li>
                    <li><a href="">Rejected</a></li>
                </ul>
            </li> -->
            <li><a href="..\includes\logout.php">LOG-OUT</a></li>
        </ul>
    </nav>
</body>
<style>
    .nav-bar {
  background-color: #333;
  position: relative;
  z-index: 999;
}

.nav-bar ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  background: rgb(154, 154, 254);
}
.nav-bar ul li {
  display: inline-block;
}
.nav-bar li a {
  color: white;
  display: block;
  padding: 10px 20px;
  text-decoration: none;
}
.nav-bar ul ul {
  position: absolute;
  top: 100%;
  display: none;
}
.nav-bar ul ul li {
  display: block;
}
.nav-bar li:hover ul {
  display: block;
}
.nav-bar ul ul li a:hover {
  background-color: #555;
}

</style>
</html>