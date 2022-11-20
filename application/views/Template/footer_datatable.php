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

  <!-- data tables plugins -->
  <script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
  <!-- Page level custom scripts -->
  <script src="<?= base_url('vendor/datatables/datatables-demo.js'); ?>"></script>





<!-- script form bertingkat untuk load data pembayaran listrik dari json-->
  <script type="text/javascript">
    $(document).ready(function(){
      $("select[name=santri]").on("change",function(){
        // ambil id_santri dari atribut pribadi yang di pilih
        var id_santri_terpilih = $("option:selected",this).attr('value');
        $.ajax({
          type:'post',
          url:'<?php if ($title == 'Uang Listrik Masuk') {echo base_url('Administrator/get_berapa_bayar_listrik');} elseif ($title == 'Uang Kesehatan Masuk') {echo base_url('Administrator/get_berapa_bayar_kesehatan');} elseif ($title == 'Uang Infaq Santri') {echo base_url('Administrator/get_berapa_bayar_infaq');}  elseif ($title == 'Data Uang Kas') {echo base_url('Bendahara/get_berapa_bayar_kas');} elseif ($title == 'Data Uang Beras') {echo base_url('Bendahara/get_berapa_bayar_beras');} elseif ($title == 'Data Uang Lauk') {echo base_url('Bendahara/get_berapa_bayar_lauk');} ?>',
          data:'id_santri='+id_santri_terpilih,
          success:function(hasil_bayar)
          {
            console.log(hasil_bayar);

            const jumlah = document.querySelector('input#jumlah');
            jumlah.setAttribute('value',hasil_bayar);
            jumlah.setAttribute('placeholder',hasil_bayar); 

            // $('.form-jumlah').html(hasil_bayar);
            // $("number[name=jumlah]").html(hasil_bayar);
          }
        })
      })
    });
  </script>


  <?php   if ($title == 'Data Uang Bangunan2') {?>
    <?php foreach ($data_santri  as $dt){ ?>

      <script type="text/javascript">
        let tes_<?= $dt['id_santri']; ?> = document.getElementById("tombol_<?= $dt['id_santri']; ?>").
        addEventListener("click", tampilkan_data);

        function tampilkan_data() 
        {
          let data       = '<iframe src="<?= base_url('Amankeun/detail_bangunan/'.$dt['id_santri']); ?>" class="p-0 m-0 responsive-iframe" frameborder="0" style="width: 100%; height: 50vh;" />';

          document.getElementById("detail_bangunan").innerHTML=data;
          console.log(data);      
        }
        console.log(tampilkan_data);
      </script>

    <?php } ?>
  <?php   } ?>  



</body>

</html>
