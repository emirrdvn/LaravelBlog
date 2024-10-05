</div>
</div>
<!-- Footer-->
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    @php $socials=['facebook','twitter','github','linkedin','youtube','instagram'] @endphp
                    @foreach($socials as $social)
                    @if($config->$social!=null)
                    <li class="list-inline-item">
                        <a href="{{$config->$social}}" target="_blank">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-{{$social}} fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                    
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('front')}}/js/scripts.js"></script>
</body>
</html>
