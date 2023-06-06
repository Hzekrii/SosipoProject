    <!--    JS Scripts    -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.js?v=2.0.4') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.js">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const darkModeSwitch = document.getElementById('dark-version');

            // Load the user's preference from localStorage
            const isDarkMode = localStorage.getItem('darkMode');

            if (isDarkMode === 'true') {
                darkModeSwitch.checked = true;
                darkMode(darkModeSwitch);
            }

            darkModeSwitch.addEventListener('change', function() {
                if (darkModeSwitch.checked) {
                    darkMode(darkModeSwitch);
                    localStorage.setItem('darkMode', true); // Store the preference in localStorage
                } else {
                    darkModeSwitch.checked = false;
                    localStorage.setItem('darkMode', false);
                    darkMode(darkModeSwitch);
                }
            });

        });
        $(document).ready(function() {
            var table = $('#table-datatable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search box
                "ordering": true, // Enable column sorting
                "info": true, // Show table information
                "responsive": true, // Enable responsive behavior
                "lengthMenu": [5, 10, 25, 50], // Set options for the number of records per page
                "pageLength": 10, // Set the initial number of records per page
                "order": [], // Disable initial sorting
                "language": { // Language settings
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                },
                "columnDefs": [ // Custom column definitions
                    {
                        "targets": 'no-sort', // Disable sorting for specific columns
                        "orderable": false
                    }
                ],
                "buttons": [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });


            // Apply the buttons configuration to the DataTable instance

        });
    </script>
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
    <script>
        const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
        const iconSidenav = document.getElementById('iconSidenav');
        const sidenav = document.getElementById('sidenav-main');
        let body = document.getElementsByTagName('body')[0];
        let className = 'g-sidenav-pinned';

        if (iconNavbarSidenav) {
            iconNavbarSidenav.addEventListener("click", toggleSidenav);
        }

        if (iconSidenav) {
            iconSidenav.addEventListener("click", toggleSidenav);
        }

        function toggleSidenav() {
            if (body.classList.contains(className)) {
                body.classList.remove(className);
                setTimeout(function() {
                    sidenav.classList.remove('bg-white');
                }, 100);
                sidenav.classList.remove('bg-transparent');

            } else {
                body.classList.add(className);
                sidenav.classList.add('bg-white');
                sidenav.classList.remove('bg-transparent');
                iconSidenav.classList.remove('d-none');
            }
        }

        let html = document.getElementsByTagName('html')[0];

        html.addEventListener("click", function(e) {
            if (body.classList.contains('g-sidenav-pinned') && !e.target.classList.contains(
                    'sidenav-toggler-line')) {
                body.classList.remove(className);
            }
        });
    </script>
    <!--  END js cripts  -->
