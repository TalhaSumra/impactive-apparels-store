export function formatPrice(value) {
    return new Intl.NumberFormat('en-US', {
        currency: 'USD',
        maximumFractionDigits: 0,
        style: 'currency',
    }).format(value ?? 0);
}
