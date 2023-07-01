import { useToast } from "vue-toastification";

export const showToast = () => {
    const toast = useToast();

    const showSuccessToast = (message) => {
        toast.success(message);
    };

    const showErrorToast = (message) => {
        toast.error(message);
    };

    // Add more functions for different types of toasts as needed

    return {
        showSuccessToast,
        showErrorToast,
        // Export other toast functions here
    };
};
