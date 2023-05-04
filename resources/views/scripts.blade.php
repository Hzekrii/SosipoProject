    <!--    JS Scripts    -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#recettes-table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": [5, 6, 7]
                }]
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showLoading(event) {
            // Prevent the link from navigating to the URL right away
            event.preventDefault();

            // Create the overlay
            var overlay = document.createElement("div");
            overlay.className = "overlay";
            document.body.appendChild(overlay);

            // Show the loading page
            var loadingPage = document.createElement("div");
            loadingPage.className = "loading";
            var logo = document.createElement("div");
            logo.className = "logo";
            loadingPage.appendChild(logo);
            var progressContainer = document.createElement("div");
            progressContainer.className = "progress-container";
            var progressBar = document.createElement("div");
            progressBar.className = "progress-bar";
            progressContainer.appendChild(progressBar);
            loadingPage.appendChild(progressContainer);
            document.body.appendChild(loadingPage);

            // Set the progress bar value to 0%
            var progressValue = 0;
            progressBar.style.width = progressValue + "%";

            // Update the progress bar every 100ms until it reaches 100%
            var interval = setInterval(function() {
                progressValue += 10;
                progressBar.style.width = progressValue + "%";
                progressBar.innerHTML = progressValue + "%";
                if (progressValue >= 100) {
                    clearInterval(interval);
                    // Redirect to the requested page after 3 seconds
                    setTimeout(function() {
                        window.location.href = event.target.href;
                    }, 700);
                }
            }, 70);
        }
    </script>
    @yield('scripts')
    <!--  END js cripts  -->
