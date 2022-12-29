<div class="container text-center maintenance" data-aos="fade-up" data-aos-duration="1000">
    <div class="row">
        <div class="col-12">
            <img src="/img/not-found.png" alt="no result" class="img-fluid mb-3" style="width: auto; height: 400px">
            @if ($keyword == '')
                <h2>Anda tidak memasukan kata kunci apapun</h2>
            @else
                <h2>Oops, hasi pencarian untuk "<strong>{{ $keyword }}</strong>" tidak ditemukan</h2>
                <p>Coba gunakan kata kunci lain atau mungkin produk tersebut belum tersedia.</p>
            @endif
        </div>
    </div>
</div>
