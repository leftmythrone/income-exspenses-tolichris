<script>
    function onCategory() {
      document.getElementById("overlaycategory").style.display = "block";
      document.getElementById("addcategorybox").style.display = "block";
      document.getElementById("addcategorybox").style.transition = '0.3s';
    }
    
    function offCategory() {
      document.getElementById("overlaycategory").style.display = "none";
      document.getElementById("addcategorybox").style.display = "none";
      document.getElementById("addcategorybox").style.transition = '0.3s';
    }

    function onTable() {
      document.getElementById("overlaytable").style.display = "block";
      document.getElementById("addtablebox").style.display = "block";
      document.getElementById("addtablebox").style.transition = '0.3s';
    }
    
    function offTable() {
      document.getElementById("overlaytable").style.display = "none";
      document.getElementById("addtablebox").style.display = "none";
      document.getElementById("addtablebox").style.transition = '0.3s';
    }
    </script>