export function formatPrice(value) {
    return new Intl.NumberFormat('en-PK', {
        currency: 'PKR',
        maximumFractionDigits: 0,
        style: 'currency',
    }).format(value ?? 0);
}
