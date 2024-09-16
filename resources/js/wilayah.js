import $ from 'jquery';

$(document).ready(function () {
    // Initial data passed from the controller
    var alamat = {
        provinsi: $('#data-provinsi').text(),
        kota: $('#data-kota').text(),
        kecamatan: $('#data-kecamatan').text(),
        kelurahan: $('#data-kelurahan').text()
    };

    // Function to select option
    function selectOption(selectElement, value) {
        selectElement.find('option').each(function() {
            if ($(this).text().toLowerCase() === value.toLowerCase()) {
                $(this).prop('selected', true);
            }
        });
    }

    // Set initial value for provinsi
    if (alamat.provinsi) {
        selectOption($('#provinsi'), alamat.provinsi);
        $('#provinsi').change(function () {
            var provinsiId = $(this).val();
            $('#kota').empty().append('<option selected disabled>Pilih Kota/Kabupaten</option>');
            $('#kecamatan').empty().append('<option selected disabled>Pilih Kecamatan</option>');
            $('#kelurahan').empty().append('<option selected disabled>Pilih Kelurahan</option>');

            if (provinsiId) {
                $.get('/get-kota/' + provinsiId, function(data) {
                    $.each(data, function (index, kota) {
                        const kotaName = kota.name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                        $('#kota').append('<option value="' + kota.id + '">' + kotaName + '</option>');
                    });
                    $('#kota').removeAttr('disabled');

                    // Select the correct kota if it matches the alamat
                    if (alamat.kota) {
                        selectOption($('#kota'), alamat.kota);
                        $('#kota').trigger('change');
                    }
                });
            } else {
                $('#kota, #kecamatan, #kelurahan').attr('disabled', 'disabled');
            }
        }).trigger('change');
    }

    // Load cities when provinsi is changed
    $('#provinsi').change(function () {
        var provinsiId = $(this).val();
        $('#kota').empty().append('<option selected disabled>Pilih Kota/Kabupaten</option>');
        $('#kecamatan').empty().append('<option selected disabled>Pilih Kecamatan</option>');
        $('#kelurahan').empty().append('<option selected disabled>Pilih Kelurahan</option>');

        if (provinsiId) {
            $.get('/get-kota/' + provinsiId, function(data) {
                $.each(data, function (index, kota) {
                    const kotaName = kota.name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                    $('#kota').append('<option value="' + kota.id + '">' + kotaName + '</option>');
                });
                $('#kota').removeAttr('disabled');

                // Select the correct kota if it matches the alamat
                if (alamat.kota) {
                    selectOption($('#kota'), alamat.kota);
                    $('#kota').trigger('change');
                }
            });
        } else {
            $('#kota, #kecamatan, #kelurahan').attr('disabled', 'disabled');
        }
    });

    // Load kecamatan when kota is changed
    $('#kota').change(function () {
        var kotaId = $(this).val();
        $('#kecamatan').empty().append('<option selected disabled>Pilih Kecamatan</option>');
        $('#kelurahan').empty().append('<option selected disabled>Pilih Kelurahan</option>');

        if (kotaId) {
            $.get('/get-kecamatan/' + kotaId, function(data) {
                $.each(data, function (index, kecamatan) {
                    const kecamatanName = kecamatan.name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                    $('#kecamatan').append('<option value="' + kecamatan.id + '">' + kecamatanName + '</option>');
                });
                $('#kecamatan').removeAttr('disabled');

                // Select the correct kecamatan if it matches the alamat
                if (alamat.kecamatan) {
                    selectOption($('#kecamatan'), alamat.kecamatan);
                    $('#kecamatan').trigger('change');
                }
            });
        } else {
            $('#kecamatan, #kelurahan').attr('disabled', 'disabled');
        }
    });

    // Load kelurahan when kecamatan is changed
    $('#kecamatan').change(function () {
        var kecamatanId = $(this).val();
        $('#kelurahan').empty().append('<option selected disabled>Pilih Kelurahan</option>');

        if (kecamatanId) {
            $.get('/get-kelurahan/' + kecamatanId, function(data) {
                $.each(data, function (index, kelurahan) {
                    const kelurahanName = kelurahan.name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                    $('#kelurahan').append('<option value="' + kelurahan.id + '">' + kelurahanName + '</option>');
                });
                $('#kelurahan').removeAttr('disabled');

                // Select the correct kelurahan if it matches the alamat
                if (alamat.kelurahan) {
                    selectOption($('#kelurahan'), alamat.kelurahan);
                }
            });
        } else {
            $('#kelurahan').attr('disabled', 'disabled');
        }
    });
});
