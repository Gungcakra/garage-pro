@push('scripts')
<script>
    $(function() {
$("#kt_datepicker_1").flatpickr();

        Livewire.on('show-modal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('ServiceModal'), {});
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('ServiceModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
            modal.hide();
            modal.dispose();
            }
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open'); 
            document.body.style.overflow = ''; 
            document.body.style.paddingRight = ''; 
        });
        Livewire.on('confirm-delete', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Yes"
                , cancelButtonText: "No"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteService');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });
       
      
        
        
    });
  
    function handleSearch() {
            Livewire.dispatch('loadData')
        }

        function printMainContent() {
            var printContents = document.querySelector('.main').innerHTML;
            var originalContents = document.body.innerHTML;

            var printStyle = document.createElement('style');
            printStyle.innerHTML = `
            @page {
                size: A4 portrait;
                margin: 20mm;
            }
            `;
            document.head.appendChild(printStyle);

            document.body.innerHTML = printContents;
            document.title = "Invoice";
            window.print();
            document.body.innerHTML = originalContents;
            document.head.removeChild(printStyle);

        }

        function back() {
            window.Livewire.navigate('servicedetail');
        }


let qrScanner = null; 

function scanQr() {
    console.log("scanQr started");
    const videoElem = document.getElementById('qr-video');

    if (!videoElem) {
        console.error("QR video element not found");
        return;
    }

    qrScanner = new QrScanner(
        videoElem,
        result => {
            console.log('Scanned QR:', result);
            qrScanner.stop();

            const id = result?.data?.split('#')[1]?.trim();
            if (id) {
                Livewire.dispatch('getInvoiceFromQr', {
                    code: `#${id}`
                });

                const modalEl = document.getElementById('scanQr');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                    modal.dispose();
                }
                modalEl.style.display = 'none';
                modalEl.setAttribute('aria-hidden', 'true');
                modalEl.removeAttribute('aria-modal');
                modalEl.removeAttribute('role');
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                closeCamera();
            } else {
                console.error('Invalid QR data format');
                alert('Invalid QR code format. Please try again.');
            }
        },
        {
            returnDetailedScanResult: true
        }
    );

    qrScanner.start().catch(e => {
        alert("Camera access denied or not found.");
        console.error("Error starting QR scanner:", e);
    });
}



function closeCamera() {
    if (qrScanner) {
        qrScanner.stop();
        qrScanner.destroy();
        qrScanner = null;
    }

    const videoElem = document.getElementById('qr-video');
    if (videoElem && videoElem.srcObject) {
        videoElem.srcObject.getTracks().forEach(track => track.stop());
        videoElem.srcObject = null;
    }
}


$("#kt_datepicker_1").flatpickr();

</script>
@endpush