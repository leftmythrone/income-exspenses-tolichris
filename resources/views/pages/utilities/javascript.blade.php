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

  // EDIT DEBT LIST

    function onPaidTable() {
      document.getElementById("overlaypaidtable").style.display = "block";
      document.getElementById("paidtablebox").style.display = "block";
      document.getElementById("paidtablebox").style.transition = '0.3s';
    }
    
    function offPaidTable() {
      document.getElementById("overlaypaidtable").style.display = "none";
      document.getElementById("paidtablebox").style.display = "none";
      document.getElementById("paidtablebox").style.transition = '0.3s';
    }

  // USER ADD TABLE

    function onUseraddTable() {
      document.getElementById("overlayuser").style.display = "block";
      document.getElementById("adduserbox").style.display = "block";
      document.getElementById("adduserbox").style.transition = '0.3s';
    }
    
    function offUseraddTable() {
      document.getElementById("overlayuser").style.display = "none";
      document.getElementById("adduserbox").style.display = "none";
      document.getElementById("adduserbox").style.transition = '0.3s';
    }

  // USER ADD TABLE


    function onUsereditTable() {
      document.getElementById("overlayedituser").style.display = "block";
      document.getElementById("edituserbox").style.display = "block";
      document.getElementById("edituserbox").style.transition = '0.3s';
    }
    
    function offUsereditTable() {
      document.getElementById("overlayedituser").style.display = "none";
      document.getElementById("edituserbox").style.display = "none";
      document.getElementById("edituserbox").style.transition = '0.3s';
    }


  // DELETE CATEGORY

    function onDeleteCategory() {
      document.getElementById("overlaydeletecategory").style.display = "block";
      document.getElementById("deletecategorybox").style.display = "block";
      document.getElementById("deletecategorybox").style.transition = '0.3s';
    }
    
    function offDeleteCategory() {
      document.getElementById("overlaydeletecategory").style.display = "none";
      document.getElementById("deletecategorybox").style.display = "none";
      document.getElementById("deletecategorybox").style.transition = '0.3s';
    }

  // DELETE TABLE LIST 

    function ondDeleteTable() {
      document.getElementById("overlaydeletetable").style.display = "block";
      document.getElementById("deletetablebox").style.display = "block";
      document.getElementById("deletetablebox").style.transition = '0.3s';
    }
    
    function offDeleteTable() {
      document.getElementById("overlaydeletetable").style.display = "none";
    document.getElementById("deletetablebox").style.display = "none";
      document.getElementById("deletetablebox").style.transition = '0.3s';
    }

  // DO SUM LIST 

  function ondSum() {
      document.getElementById("overlaysum").style.display = "block";
      document.getElementById("sumbox").style.display = "block";
      document.getElementById("sumbox").style.transition = '0.3s';
    }
    
    function offSum() {
      document.getElementById("overlaysum").style.display = "none";
    document.getElementById("sumbox").style.display = "none";
      document.getElementById("sumbox").style.transition = '0.3s';
    }

    function ondSub() {
      document.getElementById("overlaysub").style.display = "block";
      document.getElementById("subbox").style.display = "block";
      document.getElementById("subbox").style.transition = '0.3s';
    }
    
    function offSub() {
      document.getElementById("overlaysub").style.display = "none";
    document.getElementById("subbox").style.display = "none";
      document.getElementById("subbox").style.transition = '0.3s';
    }


    function ondSub() {
      document.getElementById("overlaysub").style.display = "block";
      document.getElementById("subbox").style.display = "block";
      document.getElementById("subbox").style.transition = '0.3s';
    }
    
    function offSub() {
      document.getElementById("overlaysub").style.display = "none";
    document.getElementById("subbox").style.display = "none";
      document.getElementById("subbox").style.transition = '0.3s';
    }

    function onnAccountAdd() {
      document.getElementById("overlayaddaccount").style.display = "block";
      document.getElementById("addaccount").style.display = "block";
      document.getElementById("addaccount").style.transition = '0.3s';
    }
    
    function offAccountAdd() {
      document.getElementById("overlayaddaccount").style.display = "none";
    document.getElementById("addaccount").style.display = "none";
      document.getElementById("addaccount").style.transition = '0.3s';
    }

    function onnAccountEdit() {
      document.getElementById("overlayediteaccount").style.display = "block";
      document.getElementById("editaccount").style.display = "block";
      document.getElementById("editaccount").style.transition = '0.3s';
    }
    
    function offAccountEdit() {
      document.getElementById("overlayediteaccount").style.display = "none";
    document.getElementById("editaccount").style.display = "none";
      document.getElementById("editaccount").style.transition = '0.3s';
    }


    function onnAccountDelete() {
      document.getElementById("overlaydeleteaccount").style.display = "block";
      document.getElementById("deleteaccount").style.display = "block";
      document.getElementById("deleteaccount").style.transition = '0.3s';
    }
    
    function offAccountDelete() {
      document.getElementById("overlaydeleteaccount").style.display = "none";
    document.getElementById("deleteaccount").style.display = "none";
      document.getElementById("deleteaccount").style.transition = '0.3s';
    }

    function onnClear() {
      document.getElementById("overlayclear").style.display = "block";
      document.getElementById("cleartable").style.display = "block";
      document.getElementById("cleartable").style.transition = '0.3s';
    }
    
    function offClear() {
      document.getElementById("overlayclear").style.display = "none";
    document.getElementById("cleartable").style.display = "none";
      document.getElementById("cleartable").style.transition = '0.3s';
    }

</script>