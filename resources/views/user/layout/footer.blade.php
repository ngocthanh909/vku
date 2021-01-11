<div class="container-fluid mt-3">
    <div class="row bg-white">
        <div class="container">
            <div class="row p-4">
                <div class="col-md-2">
                    <img src="https://lh3.googleusercontent.com/proxy/Di3ohR2ldRIIvCoEVfBpYVroBaP7PzIHuK5G66T5znOgVDizYvKhfj9ctlYooTX7jla88C6cjZoBaIpvKoE" class="img-fluid">
                </div>
                <div class="col-md-6 mb-2">
                    <div class="footer-block1-title">Đại học CNTT và truyền thông Việt Hàn</div>
                    <div class="footer-block1-place"><i class="fas fa-map-marker-check"></i> Khu đô thị Đại học Đà Nẵng, 470 Đường Trần Đại Nghĩa, phường Hòa Quý, quận Ngũ Hành Sơn, Đà Nẵng</div>
                    <div>
                        <div class="footer-block1-phone"><i class="fas fa-phone"></i> 0236.6.552.688</div>
                        <div class="footer-block1-phone"><i class="fas fa-phone"></i> info@vku.udn.vn</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form id="subscribe">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="email" class="mr-2 form-control" placeholder="Email của bạn"><button id="btnsub" type="submit" class="btn btn-danger">Đăng kí</button>
                        </div>
                        <small>Đăng kí nhận tin tức tuyển sinh từ VKU</small>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $("#subscribe").submit(function(e) {
                                event.preventDefault();
                                var data = $('#subscribe').serialize();
                                console.log(data);
                                $.ajax({
                                    type: "post"
                                    , url: "{{route('subscribe')}}"
                                    , cache: false
                                    , data: data
                                    , dataType: "json"
                                    , success: function(response) {
                                        alert(response.msg);
                                    }
                                    , error: function(error) {
                                        alert("Lỗi xảy ra! Hãy chắc chắn bạn chưa đăng kí trước đó");
                                    }
                                });
                            })
                        }) 
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
