async function fetchData() {
    const size = 'XL';
    const name = 'T-shirt';

    try {
        const response = await fetch(`/api/available?size=${size}&name=${name}`);
        const data = await response.json();
        console.log(data.name);
    } catch (error) {
        console.error('Wystąpił błąd:', error);
    }
}

fetchData();
