export function trow(orderby, row) {
  return (
    "<tr> <td " +
    (orderby == "name" ? 'class="ordered"' : "") +
    ">" +
    row.first_name +
    " " +
    row.last_name +
    "</td>  " +
    "<td " +
    (orderby == "department" ? 'class="ordered"' : "") +
    ">" +
    row.title +
    "</td> " +
    "<td " +
    (orderby == "class" ? 'class="ordered"' : "") +
    ">" +
    row.dept_name +
    "</td> " +
    "<td " +
    (orderby == "date" ? 'class="ordered"' : "") +
    ">" +
    row.hire_date +
    "</td> "+
    "<td class=\"text-center\"> <button data-id=\""+row.emp_no+"\" class=\"delete-btn\"><i class=\"fa-solid fa-trash\"></i></button> </td>"+
    "</tr>" 
  );
}

export function paginatelinks(page_number, from) {
  let paginate = '<select id="select_paginate" >';

  for (let i = 0; i < page_number; i++) {
    if (
      (i <= from / 20 + 50 && i >= from / 20 - 50) ||
      (i + 1) % 100 == 0 ||
      i + 1 > page_number - 10
    ) {
      paginate +=
        "<option " +
        (from / 20 == i ? "selected" : "") +
        ' value="' +
        i +
        '">' +
        (i + 1) +
        "</option>";
    }
  }
  paginate += "</select>";

  return paginate;
}
