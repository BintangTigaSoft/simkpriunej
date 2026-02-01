/**
 * RispinCRUD Helper Class
 * Menyederhanakan proses CRUD AJAX dengan standard CodeIgniter 4 & Myth Auth
 */

class RispinCRUD {
  constructor(config) {
    // Konfigurasi Standar
    this.baseUrl = config.baseUrl;
    this.tableId = config.tableId;
    this.modalId = config.modalId;
    this.formId = config.formId;
    this.title = config.title || "Data";

    // Config CSRF (Default mengikuti CodeIgniter)
    this.csrfTokenName = config.csrfTokenName || "csrf_test_name";
    this.csrfCookieName = config.csrfCookieName || "csrf_cookie_name";

    // Callbacks untuk Custom Logic
    this.onEditInfo = config.onEditInfo || function (data) {}; // Function untuk isi form saat edit
    this.onViewInfo = config.onViewInfo || null; // Function untuk isi form saat view
    this.onSuccess = config.onSuccess || null;

    // Internal
    this.modal = new bootstrap.Modal(document.getElementById(this.modalId));
    this.form = $(`#${this.formId}`);
    this.saveUrl = "";

    // Initialize
    this.init();
  }

  // Helper: Ambil Cookie CSRF
  getCookie(name) {
    let matches = document.cookie.match(
      new RegExp(
        "(?:^|; )" +
          name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
          "=([^;]*)",
      ),
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  // Initialize Events
  init() {
    console.log(`RispinCRUD Initialized for ${this.title}`);

    // Save Button (Gunakan .off() untuk mencegah duplicate binding)
    $("#btnSave")
      .off("click")
      .on("click", (e) => {
        e.preventDefault();
        this.save();
      });

    // Delegated Events untuk Tombol di Tabel (Edit, View, Delete)
    const self = this;
    $(document)
      .off("click", ".btn-edit")
      .on("click", ".btn-edit", function () {
        self.edit($(this).data("id"));
      });

    $(document)
      .off("click", ".btn-view")
      .on("click", ".btn-view", function () {
        self.view($(this).data("id"));
      });

    $(document)
      .off("click", ".btn-delete")
      .on("click", ".btn-delete", function () {
        self.delete($(this).data("id"));
      });
  }

  // Reset Form
  reset() {
    this.form[0].reset();
    this.form.find(".is-invalid").removeClass("is-invalid");
    this.form.find("input, textarea, select").prop("disabled", false);
    $("#btnSave").show();
    $(`#${this.modalId}Label`).text(`${this.title} Form`);
  }

  // Open Modal Add
  add() {
    this.reset();
    this.saveUrl = this.baseUrl + "/create";
    $(`#${this.modalId}Label`).text(`Add ${this.title}`);
    this.modal.show();
  }

  // Open Modal Edit
  edit(id) {
    this.reset();
    this.saveUrl = this.baseUrl + "/update/" + id;
    $(`#${this.modalId}Label`).text(`Edit ${this.title}`);
    this.fetch(id, "edit");
  }

  // Open Modal View
  view(id) {
    this.reset();
    $(`#${this.modalId}Label`).text(`View ${this.title}`);
    this.form.find("input, textarea, select").prop("disabled", true);
    $("#btnSave").hide();
    this.fetch(id, "view");
  }

  // Fetch Data from Server
  fetch(id, mode) {
    $.get(this.baseUrl + "/show/" + id, (res) => {
      if (res.status === "success") {
        if (mode === "edit") this.onEditInfo(res.data);
        if (mode === "view") {
          // Jika onViewInfo ada, pakai itu. Jika tidak, fallback ke onEditInfo.
          if (this.onViewInfo) {
            this.onViewInfo(res.data);
          } else {
            this.onEditInfo(res.data);
          }
        }
        this.modal.show();
      } else {
        Swal.fire("Error", res.message || "Data not found", "error");
      }
    }).fail(() => {
      Swal.fire("Error", "Failed to fetch data", "error");
    });
  }

  // Reload Datatable (Supports multiple naming conventions)
  reloadTable() {
    // Coba cari function reload standard
    let fnName = "reloadTable_" + this.tableId;
    if (typeof window[fnName] === "function") {
      window[fnName]();
      return;
    }

    // Coba cari function reload yang digenerate helper (biasanya ada underscore extra/convert dash)
    let jsVar = "table_" + this.tableId.replace(/-/g, "_");
    let fnName2 = "reloadTable_" + jsVar;
    if (typeof window[fnName2] === "function") {
      window[fnName2]();
      return;
    }

    console.warn(`Cannot find reload function for table ${this.tableId}`);
  }

  // Save Data (Create/Update)
  save() {
    // Ambil CSRF Token terbaru
    let csrfToken = this.getCookie(this.csrfCookieName) || "";
    let formData = new FormData(this.form[0]);
    formData.append(this.csrfTokenName, csrfToken);

    $.ajax({
      url: this.saveUrl,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: (res) => {
        if (res.status === "success") {
          this.modal.hide();
          this.reloadTable();
          Swal.fire("Success", res.message, "success");
          if (this.onSuccess) this.onSuccess(res);
        } else {
          this.showErrors(res.errors);
        }
      },
      error: (xhr) => {
        let msg = "Server Error";
        if (xhr.responseJSON && xhr.responseJSON.message)
          msg = xhr.responseJSON.message;
        Swal.fire("Error", msg, "error");
      },
    });
  }

  // Delete Data
  delete(id) {
    if (!id) return Swal.fire("Error", "Invalid ID", "error");

    Swal.fire({
      title: `Delete ${this.title}?`,
      text: "This action cannot be undone!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed || result.value === true) {
        try {
          let csrfToken = this.getCookie(this.csrfCookieName) || "";
          let data = { _method: "DELETE" };
          data[this.csrfTokenName] = csrfToken;

          $.ajax({
            url: this.baseUrl + "/delete/" + id,
            type: "POST",
            data: data,
            success: (res) => {
              if (res.status === "success") {
                this.reloadTable();
                Swal.fire("Deleted!", res.message, "success");
              } else {
                Swal.fire(
                  "Failed!",
                  res.message || "Could not delete data",
                  "error",
                );
              }
            },
            error: (xhr) => {
              let msg = "Unknown Error";
              if (xhr.responseJSON && xhr.responseJSON.message)
                msg = xhr.responseJSON.message;
              else if (xhr.statusText) msg = xhr.statusText;
              Swal.fire("Error!", msg, "error");
            },
          });
        } catch (err) {
          console.error("Delete error:", err);
          Swal.fire("Error", "An unexpected error occurred", "error");
        }
      }
    });
  }

  // Show Validation Errors
  showErrors(errors) {
    if (!errors) return Swal.fire("Error", "Validation failed", "error");
    // Clear old errors
    this.form.find(".is-invalid").removeClass("is-invalid");
    this.form.find(".invalid-feedback").text("");

    // Show new errors
    for (let key in errors) {
      $(`#${key}`)
        .addClass("is-invalid")
        .siblings(".invalid-feedback")
        .text(errors[key]);
    }
  }
}
