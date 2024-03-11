<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
</head>

<body>
    <div class="container">
        <label for="level">Select Level</label>
        <select name="level" id="level" onchange="showhide()">
            <option value="">select</option>
            <option value="undergraduate">Under-Graduate</option>
            <option value="bachelor">Bachelor</option>
            <option value="master">Master</option>
            <option value="phd">PhD</option>
        </select>
        <br>
        <label for="coursename">Course Name</label>
        <input type="text" name="coursename" id="coursename" placeholder="coursename" required>
        <br>
        <label for="duration">Duration</label>
        <input type="text" name="duration" id="duration" placeholder="duration (in semester)" required>
        <br>
        <label for="startdate">Start Date</label>
        <input type="date" name="startdate" id="startdate" required>
        <label for="enddate">End Date</label>
        <input type="date" name="enddate" id="enddate" required>
        <br>
        <label for="courserequirements">Course Requirements:</label>
        <br>
        <label for="ielts">IELTS</label>
        <br>
        <label for="listening">Listinig</label>
        <input type="number" name="listening" id="ilistening" placeholder="Listening" required>
        <label for="reading">Reading</label>
        <input type="number" name="reading" id="ireading" placeholder="Reading" required>
        <label for="writing">Writing</label>
        <input type="number" name="writing" id="iwriting" placeholder="Writing" required>
        <label for="speaking">Speaking</label>
        <input type="number" name="speaking" id="ispeaking" placeholder="Speaking" required>
        <label for="overall-band">Overall Band</label>
        <input type="number" name="overallband" id="overallband" placeholder="Overall" required>
        <br>
        <label for="pte">PTE</label>
        <br>
        <label for="listening">Listinig</label>
        <input type="number" name="listening" id="plistening" placeholder="Listening" required>
        <label for="reading">Reading</label>
        <input type="number" name="reading" id="preading" placeholder="Reading" required>
        <label for="writing">Writing</label>
        <input type="number" name="writing" id="pwriting" placeholder="Writing" required>
        <label for="speaking">Speaking</label>
        <input type="number" name="speaking" id="pspeaking" placeholder="Speaking" required>
        <label for="overall-score">Overall Score </label>
        <input type="number" name="overallscore" id="overallscore" placeholder="Overall" required>
        <br>
        <label for="academic-requirements">Academic Requirements</label>
        <br>
        <label for="secondary">Secondary</label>
        <br>
        <label for="GPA"> Min. GPA</label>
        <input type="number" name="sgpa" id="sgpa" required>
        <label for="spercentage">Min. Percentage</label>
        <input type="text" name="spercentage" id="spercentage" required>
        <br>
        <label for="secondary">Higher-Secondary</label>
        <br>
        <label for="GPA">Min. GPA</label>
        <input type="number" name="hgpa" id="hgpa" required>
        <label for="hpercentage">Min. Percentage</label>
        <input type="text" name="hpercentage" id="hpercentage" required>
        <br>
        <div class="hide master">
            <label for="bachelor">Bachelor</label>
            <br>
            <label for="GPA">Min. GPA</label>
            <input type="number" name="bgpa" id="bgpa" required>
            <label for="bpercentage">Min. Percentage</label>
            <input type="text" name="bpercentage" id="bpercentage" required>
            <br>
        </div>
            <div class="hide phd">
                <label for="phd">Master</label>
                <br>
                <label for="GPA">Min. GPA</label>
                <input type="number" name="mgpa" id="mgpa" required>
                <label for="mpercentage">Min. Percentage</label>
                <input type="text" name="mpercentage" id="mpercentage" required>
                <br>
            </div>
            <button onclick="addcourse">Add Course</button>


        


    </div>
    <style>
        .hide {
            display: none;
        }
    </style>
    <script>
        function showhide() {
            var level = document.getElementById('level').value;
            if (level == 'master') {
                document.querySelector('.master').classList.remove('hide');
                document.querySelector('.phd').classList.add('hide');
            } else if (level == 'phd') {
                document.querySelector('.phd').classList.remove('hide');
            } else {
                document.querySelector('.phd').classList.add('hide');
                document.querySelector('.master').classList.add('hide');
            }
        }
        function addcourse(){
            const coursename = document.querySelector('#coursename').value;
            const duration = document.querySelector('#duration').value;
            const startdate = document.querySelector('#startdate').value;
            const enddate = document.querySelector('#enddate').value;
            const ilistening = document.querySelector('#ilistening').value;
            const ireading = document.querySelector('#ireading').value;
            const iwriting = document.querySelector('#iwriting').value;
            const ispeaking = document.querySelector('#ispeaking').value;
            const overallband = document.querySelector('#overallband').value;
            
            const plistening = document.querySelector('#plistening').value;
            const preading = document.querySelector('#preading').value;
            const pwriting = document.querySelector('#pwriting').value;
            const pspeaking = document.querySelector('#pspeaking').value;
            const overallscore = document.querySelector('#overallscore').value;

            const sgpa = document.querySelector('#sgpa').value;
            const spercentage = document.querySelector('#spercentage').value;
            const hgpa = document.querySelector('#hgpa').value;
            const hpercentage = document.querySelector('#hpercentage').value;
            const bgpa = document.querySelector('#bgpa').value;
            const bpercentage = document.querySelector('#bpercentage').value;
            const pgpa = document.querySelector('#pgpa').value;
            const ppercentage = document.querySelector('#ppercentage').value;
          
            const data = new FormData();

            data.append('coursename', coursename);
            data.append('duration', duration);
            data.append('startdate', startdate);
            data.append('enddate', enddate);
            data.append('ilistening', ilistening);
            data.append('ireading', ireading);
            data.append('iwriting', iwriting);
            data.append('ispeaking', ispeaking);
            data.append('overallband', overallband);
            
            data.append('plistening', plistening);
            data.append('preading', preading);
            data.append('pwriting', pwriting);
            data.append('pspeaking', pspeaking);
            data.append('overallscore', overallscore);
            data.append('sgpa', sgpa);
            data.append('spercentage', spercentage);
            data.append('hgpa', hgpa);
            data.append('hpercentage', hpercentage);
            if(level == 'master'){
                data.append('pgpa', pgpa);
                data.append('ppercentage', ppercentage);
            }
            else if(level == 'phd'){
                data.append('bgpa', bgpa);
                data.append('bpercentage', mpercentage);
                data.append('mgpa', mgpa);
                data.append('mpercentage', mpercentage);
            }
        try{
            const response =fetch("../includes/add-course.inc.php", {
                method: "post",
                body: data,
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = response.text();
            if(result == 'success'){
                alert('Course Added Successfully');
            }
            else{
                alert('There has been a problem with your fetch operation');
            }

        }  
catch (error) {
            console.error('There has been a problem with your fetch operation:', error);

        }
    }
    </script>
</body>

</html>