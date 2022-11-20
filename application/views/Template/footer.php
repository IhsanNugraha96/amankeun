 <!-- Footer -->
      <footer class="sticky-footer bg-white shadow-sm">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <b>Institut Teknologi Garut</b> <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js');?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('vendor/sb-admin/js/sb-admin-2.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url('vendor/chart.js/Chart.min.js');?>"></script>




<?php   if ($title == 'Data Uang Bangunan') {?>
<?php foreach ($data_Santri  as $dt): ?>
  
<script type="text/javascript">
  let tes = document.getElementById("tombol_<?= $dt['id_santri']; ?>").
  addEventListener("click", tampilkan_data);
  
console.log(tes);
  function tampilkan_data() 
  {
    let data       = '<iframe src="<?= base_url('Bendahara/detail_pembayaran_bangunan_santri/'.$dt['id_santri']); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    
        document.getElementById("detail_bangunan").innerHTML=data;
        console.log(data);      
  }
</script>

<?php endforeach ?>
<?php   } ?>  



<?php   if ($title == 'Laporan Keuangan') {?>
<?php foreach ($bulan  as $bl): ?>
  
<script type="text/javascript">
  document.getElementById("tombol_<?= $bl;?>").
  addEventListener("click", tampilkan_data);
  

  function tampilkan_data() 
  {
    <?php $thn = date('Y'); ?>
    <?php   if ($bl == '1') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/01/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   }

    else if ($bl == '2') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/02/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '3') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/03/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   }  

    else if ($bl == '4') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/04/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '5') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/05/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '6') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/06/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '7') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/07/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '8') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/08/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '9') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/09/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '10') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/10/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '11') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/11/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } 

    else if ($bl == '12') { ?>
        let kas       = '<iframe src="<?= base_url('Amankeun/laporan_kas/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let listrik   = '<iframe src="<?= base_url('Amankeun/laporan_listrik/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let lauk      = '<iframe src="<?= base_url('Amankeun/laporan_lauk/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let beras     = '<iframe src="<?= base_url('Amankeun/laporan_beras/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let kesehatan = '<iframe src="<?= base_url('Amankeun/laporan_kesehatan/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let infaq     = '<iframe src="<?= base_url('Amankeun/laporan_infaq/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bangunan  = '<iframe src="<?= base_url('Amankeun/laporan_bangunan/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
        let bantuan   = '<iframe src="<?= base_url('Amankeun/laporan_bantuan/12/'.$thn); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" />'
    <?php   } ?>
        // var url = encodeURI(hasil);
        document.getElementById("view1").innerHTML=kas;
        document.getElementById("view2").innerHTML=listrik;        
        document.getElementById("view3").innerHTML=beras;
        document.getElementById("view4").innerHTML=lauk;
        document.getElementById("view5").innerHTML=kesehatan;
        document.getElementById("view6").innerHTML=infaq;
        document.getElementById("view7").innerHTML=bangunan;
        document.getElementById("view8").innerHTML=bantuan;
        console.log(kas);      
    }
</script>

<?php endforeach ?>
<?php   } ?>



</body>

</html>
