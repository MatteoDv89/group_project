const link_delete = document.querySelectorAll(".link_delete");


link_delete.forEach((link) =>
  link.addEventListener("click", (e) => {
    let target = e.path[1].href;

    if (confirm("Confirmer la suppression?")) {
      document.location.href = target;
    }
    e.preventDefault();

    return false;
  })
);
