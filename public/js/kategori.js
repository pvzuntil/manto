$(function () {
     $('#sidenav').sidenav();
     $('.materialboxed').materialbox();
     $('.fixed-action-btn').floatingActionButton();
     $('.materialize-textarea').characterCounter();
     $('.tooltiped').tooltip();
     $('.modal').modal();
     
     $('.tambahTrigger').click(function () {
          $('#fieldTambahKat').animate({
               height: 'toggle'
          });
          $('.tambahTrigger').addClass('scale-out');
          $('.tambahTrigger').removeClass('scale-in');
          $('#nama').focus();
     });
     
     $('.batalTrigger').click(function () {
          $('#fieldTambahKat').animate({
               height: 'toggle'
          });
          $('.tambahTrigger').removeClass('scale-out');
          $('.tambahTrigger').addClass('scale-in');
     });
});
