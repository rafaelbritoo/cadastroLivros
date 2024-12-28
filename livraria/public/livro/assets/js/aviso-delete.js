function confirmDelete(descricao, codAs) {
    Swal.fire({
        title: 'Tem certeza?',
        html: `Você está prestes a excluir <strong>${descricao}</strong>. Esta ação não pode ser desfeita.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, Apagar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Envia o formulário
            document.getElementById('delete-form-' + codAs).submit();
        }
    });
}
