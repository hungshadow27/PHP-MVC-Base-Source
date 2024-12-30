const formContainer = document.getElementById("formContainer");
const loadingContainer = document.getElementById("loadingContainer");
const alertContainer = document.getElementById("alertContainer");

const btnShowEditForm = async (e, contract_id) => {
  e.preventDefault();
  loadingContainer.style.display = "block";
  try {
    const resContract = await fetch(
      "<?= ROOT ?>/contract/getById?id=" + contract_id
    );
    const dataContract = await resContract.json();
    console.log(dataContract);
    setTimeout(() => {
      loadingContainer.style.display = "none";
      createEditForm(dataContract);
    }, 500);
  } catch (error) {
    console.log("There was an error", error);
  }
};
const getPackagesBySupplier = async (e, package) => {
  e.preventDefault();
  loadingContainer.style.display = "block";
  try {
    console.log(package);
    const supplier_id = document.getElementById(
      "input-contract-supplier"
    ).value;
    const resPackages = await fetch(
      "<?= ROOT ?>/package/getBySupplier?id=" + supplier_id
    );
    let dataPackages = await resPackages.json();
    console.log(dataPackages);
    const inputPackage = document.getElementById("input-contract-package");
    let html = "";
    setTimeout(() => {
      loadingContainer.style.display = "none";
      for (let item of Object.values(dataPackages)) {
        if (item.package_id == package) {
          html += `<option value="${item.package_id}" selected>${item.package_id} - ${item.name}</option>`;
        } else {
          html += `<option value="${item.package_id}">${item.package_id} - ${item.name}</option>`;
        }
      }
      console.log(html);

      inputPackage.innerHTML = html;
    }, 500);
  } catch (error) {
    console.log("There was an error", error);
  }
};
const createEditForm = async (dataContract) => {
  loadingContainer.style.display = "block";
  try {
    const supplier_id = dataContract.supplier;
    const resPackages = await fetch(
      "<?= ROOT ?>/package/getBySupplier?id=" + supplier_id
    );
    const dataPackages = await resPackages.json();
    console.log(dataPackages);
    const resSuppliers = await fetch("<?= ROOT ?>/supplier/getAllSupplier");
    const dataSuppliers = await resSuppliers.json();
    setTimeout(() => {
      loadingContainer.style.display = "none";
      const htmlString = `
        <div class="border-4 border-black rounded text-lg space-y-2 p-3 bg-slate-700 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
              <button class="float-right font-bold text-xl bg-red-600 py-2 px-3" onclick="closeForm()">X</button>
              <div class="text-3xl text-yellow-700 w-full text-center">
                  Sửa hợp đồng
              </div>
              <div class="space-y-3">
                  <div class="whitespace-nowrap">
                      <label for="input-contract-id">Mã hợp đồng</label>
                      <input class="text-black" type="text" id="input-contract-id" readonly value="${
                        dataContract.contract_id
                      }">
                  </div>
                  <div class="whitespace-nowrap">
                      <label for="input-contract-phone-number">Số thuê bao</label></label>
                      <input class="text-black" type="text" id="input-contract-phone-number" value="${
                        dataContract.phone_number
                      }">
                  </div>
                  <div class="whitespace-nowrap">
                      <label for="input-contract-supplier">Nhà cung cấp</label>
                      <select id="input-contract-supplier" class="text-black" onchange="getPackagesBySupplier(event, '${
                        dataContract.package
                      }')">
                  ${dataSuppliers.map((item, index) => {
                    if (item.supplier_id == dataContract.supplier) {
                      return `<option value="${item.supplier_id}" selected>${item.supplier_id} - ${item.name}</option>`;
                    } else {
                      return `<option value="${item.supplier_id}">${item.supplier_id} - ${item.name}</option>`;
                    }
                  })}
                        </select>
                  </div>
                  <div class="whitespace-nowrap">
                      <label for="input-contract-package">Gói cước</label>
                      <select id="input-contract-package" class="text-black">
                  ${Object.values(dataPackages).map((item, index) => {
                    if (item.package_id == dataContract.package) {
                      return `<option value="${item.package_id}" selected>${item.package_id} - ${item.name}</option>`;
                    } else {
                      return `<option value="${item.package_id}">${item.package_id} - ${item.name}</option>`;
                    }
                  })}
                        </select>
                  </div>
                  <div class="whitespace-nowrap flex items-start gap-1">
                      <label for="input-contract-create-date">Ngày đăng ký</label>
                     <input class="text-black" type="date" id="input-contract-create-date" value="${
                       dataContract.create_date
                     }">
                  </div>
                  <div class="whitespace-nowrap flex items-start gap-1">
                      <label for="input-contract-expired-date">Ngày hết hạn</label>
                     <input class="text-black" type="date" id="input-contract-expired-date" value="${
                       dataContract.expired_date
                     }">
                  </div>
                  <div class="whitespace-nowrap">
                      <label for="input-contract-duration">Thời hạn</label>
                      <input class="text-black" type="text" id="input-contract-duration" value="${
                        dataContract.duration
                      }">
                  </div>
                  <div class="whitespace-nowrap">
                      <label for="input-contract-total-price">Thành tiền</label>
                      <input class="text-black" type="text" id="input-contract-total-price" value="${
                        dataContract.total_price
                      }">
                  </div>
              </div>
              <button class="w-full p-2 text-center bg-green-600 font-medium" onclick="handleUpdate()">Sửa</button>
          </div>
    `;
      formContainer.innerHTML = htmlString;
    }, 500);
  } catch (error) {
    console.log("There was an error", error);
  }
};
const closeForm = () => {
  formContainer.innerHTML = "";
};
const handleUpdate = async () => {
  const inputId = document.getElementById("input-contract-id");
  const inputPhoneNumber = document.getElementById(
    "input-contract-phone-number"
  );
  const inputSupplier = document.getElementById("input-contract-supplier");
  const inputPackage = document.getElementById("input-contract-package");
  const inputCreateDate = document.getElementById("input-contract-create-date");
  const inputExpiredDate = document.getElementById(
    "input-contract-expired-date"
  );
  const inputDuration = document.getElementById("input-contract-duration");
  const inputTotalPrice = document.getElementById("input-contract-total-price");

  const contractInputData = {
    contract_id: inputId.value,
    phone_number: inputPhoneNumber.value,
    supplier: inputSupplier.value,
    package: inputPackage.value,
    create_date: inputCreateDate.value,
    expired_date: inputExpiredDate.value,
    duration: inputDuration.value,
    total_price: inputTotalPrice.value,
  };
  loadingContainer.style.display = "block";
  try {
    const res = await fetch("<?= ROOT ?>/contract/update?id=" + inputId.value, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contractInputData),
    });
    const data = await res.json();
    console.log(data);
    setTimeout(() => {
      loadingContainer.style.display = "none";
      closeForm();
      updateAllRows();
      showAlertSuccess("Cập nhật hợp đồng thành công!");
    }, 500);
  } catch (error) {
    showAlertFailed("Có lỗi xảy ra!");
    console.log("There was an error", error);
  }
};
const handleDelete = async (contract_id) => {
  if (confirm("Xoá hợp đồng này?")) {
    loadingContainer.style.display = "block";
    try {
      const res = await fetch("<?= ROOT ?>/contract/delete?id=" + contract_id);
      const data = await res.json();
      console.log(data);
      setTimeout(() => {
        loadingContainer.style.display = "none";
        updateAllRows();
        showAlertSuccess("Xoá hợp đồng thành công!");
      }, 500);
    } catch (error) {
      showAlertFailed("Có lỗi xảy ra!");
      console.log("There was an error", error);
    }
  }
};
const createAddForm = async () => {
  loadingContainer.style.display = "block";
  try {
    const supplier_id = "";
    const resPackages = await fetch(
      "<?= ROOT ?>/package/getBySupplier?id=" + supplier_id
    );
    const dataPackages = await resPackages.json();
    console.log(dataPackages);
    const resSuppliers = await fetch("<?= ROOT ?>/supplier/getAllSupplier");
    const dataSuppliers = await resSuppliers.json();
    setTimeout(() => {
      loadingContainer.style.display = "none";
      const htmlString = `
          <div class="border-4 border-black rounded text-lg space-y-2 p-3 bg-slate-700 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <button class="float-right font-bold text-xl bg-red-600 py-2 px-3" onclick="closeForm()">X</button>
                <div class="text-3xl text-yellow-700 w-full text-center">
                    Thêm hợp đồng
                </div>
                <div class="space-y-3">
                    <div class="whitespace-nowrap">
                        <label for="input-contract-phone-number">Số thuê bao</label></label>
                        <input class="text-black" type="text" id="input-contract-phone-number" value="">
                    </div>
                    <div class="whitespace-nowrap">
                        <label for="input-contract-supplier">Nhà cung cấp</label>
                        <select id="input-contract-supplier" class="text-black" onchange="getPackagesBySupplier(event, '')">
                        <option value="-" selected>- Chọn nhà cung cấp -</option>
                    ${dataSuppliers.map((item, index) => {
                      return `<option value="${item.supplier_id}">${item.supplier_id} - ${item.name}</option>`;
                    })}
                          </select>
                    </div>
                    <div class="whitespace-nowrap">
                        <label for="input-contract-package">Gói cước</label>
                        <select id="input-contract-package" class="text-black">
                    ${dataPackages.map((item, index) => {
                      return `<option value="${item.package_id}">${item.package_id} - ${item.name}</option>`;
                    })}
                          </select>
                    </div>
                    <div class="whitespace-nowrap flex items-start gap-1">
                        <label for="input-contract-create-date">Ngày đăng ký</label>
                       <input class="text-black" type="date" id="input-contract-create-date" value="">
                    </div>
                    <div class="whitespace-nowrap flex items-start gap-1">
                        <label for="input-contract-expired-date">Ngày hết hạn</label>
                       <input class="text-black" type="date" id="input-contract-expired-date" value="">
                    </div>
                    <div class="whitespace-nowrap">
                        <label for="input-contract-duration">Thời hạn</label>
                        <input class="text-black" type="text" id="input-contract-duration" value="">
                    </div>
                    <div class="whitespace-nowrap">
                        <label for="input-contract-total-price">Thành tiền</label>
                        <input class="text-black" type="text" id="input-contract-total-price" value="">
                    </div>
                </div>
                <button class="w-full p-2 text-center bg-green-600 font-medium" onclick="handleAdd()">Thêm</button>
            </div>
      `;
      formContainer.innerHTML = htmlString;
    }, 500);
  } catch (error) {
    console.log("There was an error", error);
  }
};
const handleAdd = async () => {
  //const inputId = document.getElementById("input-contract-id");
  const inputPhoneNumber = document.getElementById(
    "input-contract-phone-number"
  );
  const inputSupplier = document.getElementById("input-contract-supplier");
  const inputPackage = document.getElementById("input-contract-package");
  const inputCreateDate = document.getElementById("input-contract-create-date");
  const inputExpiredDate = document.getElementById(
    "input-contract-expired-date"
  );
  const inputDuration = document.getElementById("input-contract-duration");
  const inputTotalPrice = document.getElementById("input-contract-total-price");
  const contractInputData = {
    //contract_id: inputId.value,
    phone_number: inputPhoneNumber.value,
    supplier: inputSupplier.value,
    package: inputPackage.value,
    create_date: inputCreateDate.value,
    expired_date: inputExpiredDate.value,
    duration: inputDuration.value,
    total_price: inputTotalPrice.value,
  };

  loadingContainer.style.display = "block";
  try {
    const res = await fetch("<?= ROOT ?>/contract/add", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      body: JSON.stringify(contractInputData),
    });
    const data = await res.json();
    console.log(data);
    setTimeout(() => {
      loadingContainer.style.display = "none";
      updateAllRows();
      closeForm();
      showAlertSuccess("Thêm hợp đồng thành công!");
    }, 500);
  } catch (error) {
    showAlertFailed("Có lỗi xảy ra!");
    console.log("There was an error", error);
  }
};
const updateAllRows = async () => {
  loadingContainer.style.display = "block";
  try {
    const resContracts = await fetch("<?= ROOT ?>/contract/getAllContract");
    const dataContracts = await resContracts.json();
    console.log(dataContracts);
    setTimeout(() => {
      loadingContainer.style.display = "none";
      const tableBody = document.querySelector("#contract-table");
      tableBody.innerHTML = "";
      dataContracts.forEach((contract) => {
        addNewRow(contract);
      });
    }, 500);
  } catch (error) {
    console.log("There was an error", error);
  }
};
const addNewRow = (contractData) => {
  const tableBody = document.querySelector("#contract-table");
  const newRow = document.createElement("tr");
  newRow.className = `border-b border-neutral-200 class-row-${contractData.contract_id}`;
  newRow.innerHTML = `
            <td class="whitespace-nowrap px-6 py-4 font-medium">
            ${contractData.contract_id}
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.phone_number
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.supplier
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.package
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.create_date
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.expired_date
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${
                      contractData.duration
                    }</td>
                    <td class="whitespace-nowrap px-6 py-4">${toVND(
                      contractData.total_price
                    )}</td>
                    <td class="whitespace-nowrap px-6 py-4">
                        <button style="border: 5px solid black; border-radius: 10px;" onclick="btnShowEditForm(event,'${
                          contractData.contract_id
                        }')" class="p-3 bg-yellow-500">Sửa</button>
                        <button style="border: 5px solid black; border-radius: 10px;" class="p-3 bg-red-500" onclick="handleDelete('${
                          contractData.contract_id
                        }')">Xóa</button>
                    </td>
        `;

  tableBody.appendChild(newRow);
};
function shortenString(text) {
  return text.length > 100 ? text.slice(0, 97) + "..." : text;
}
const toVND = (value) => {
  value = value.toString().replace(/\./g, "");
  const formatted = new Intl.NumberFormat("it-IT", {
    style: "currency",
    currency: "VND",
  })
    .format(value)
    .replace("₫", "")
    .trim();

  return formatted;
};
