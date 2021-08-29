document.addEventListener('alpine:init', () => {
    Alpine.data('confirmationData', () => ({
        showConfirmationPopup: false,
        method: null,
        url: null,
        message: null,
        confirmBtnText: null,
        cancelBtnText: null,
        confirmBtnClass: null,
        cancelBtnClass: null,

        updateStatusConfirmation(dataType, status, url) {
            this.method = 'put';
            this.url = url;
            this.confirmBtnText = status;
            this.cancelBtnText = 'Cancel';
            this.confirmBtnClass = status==='publish' ? 'bg-green-700 hover:bg-green-500 text-green-100' : 'bg-pink-700 hover:bg-pink-500 text-pink-100';
            this.cancelBtnClass = 'bg-gray-700 hover:bg-gray-500 text-gray-100';
            this.message = `Are you sure you want to ${status} this ${dataType}?`;
            this.showConfirmationPopup = true;
        },

        deleteConfirmation(dataType, url) {
            this.method = 'delete';
            this.url = url;
            this.confirmBtnText = 'Delete';
            this.cancelBtnText = 'Cancel';
            this.confirmBtnClass = 'bg-red-700 hover:bg-red-500 text-red-100';
            this.cancelBtnClass = 'bg-gray-700 hover:bg-gray-500 text-gray-100';
            this.message = `Are you sure you want to delete this ${dataType}?`
            this.showConfirmationPopup = true;
        }
    }));
})
