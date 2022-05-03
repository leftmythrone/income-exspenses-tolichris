<script>
  // ADD NEW CATEGORY
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

  // EDIT CATEGORY

  function onEditCategory() {
      document.getElementById("overlayeditcategory").style.display = "block";
      document.getElementById("editcategorybox").style.display = "block";
      document.getElementById("editcategorybox").style.transition = '0.3s';
      document.getElementById("editcategorybox").style.display = "block";
    }
    
    function offEditCategory() {
      document.getElementById("overlayeditcategory").style.display = "none";
      document.getElementById("editcategorybox").style.display = "none";
      document.getElementById("editcategorybox").style.transition = '0.3s';
    }


    // VIEW CATEGORY

    function onViewCategory() {
      document.getElementById("overlayviewcategory").style.display = "block";
      document.getElementById("viewcategorybox").style.display = "block";
      document.getElementById("viewcategorybox").style.transition = '0.3s';
      document.getElementById("viewcategorybox").style.display = "block";
    }
    
    function offViewCategory() {
      document.getElementById("overlayviewcategory").style.display = "none";
      document.getElementById("viewcategorybox").style.display = "none";
      document.getElementById("viewcategorybox").style.transition = '0.3s';
    }

  // ADD NEW INCOME LIST CATEGORY

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

    // VIEW INCOME LIST

    function onViewTable() {
      document.getElementById("overlayviewtable").style.display = "block";
      document.getElementById("viewtablebox").style.display = "block";
      document.getElementById("viewtablebox").style.transition = '0.3s';
    }
    
    function offViewTable() {
      document.getElementById("overlayviewtable").style.display = "none";
      document.getElementById("viewtablebox").style.display = "none";
      document.getElementById("viewtablebox").style.transition = '0.3s';
    }

    // EDIT INCOME LIST


    function onEditTable() {
      document.getElementById("overlayviewtable").style.display = "block";
      document.getElementById("viewtablebox").style.display = "block";
      document.getElementById("viewtablebox").style.transition = '0.3s';
    }
    
    function offEditTable() {
      document.getElementById("overlayedittable").style.display = "none";
      document.getElementById("edittablebox").style.display = "none";
      document.getElementById("edittablebox").style.transition = '0.3s';
    }


    </script>