
export default {
    async get(url, token) {
        url = `${process.env.VUE_APP_BACKEND_URL}${url}`
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-type": "application/json",
                "Authorization": `Bearer ${token}`
            },
        });
        return await response.json()
    },

    async post(url, body,token) {
        url = `${process.env.VUE_APP_BACKEND_URL}${url}`
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(body)
        });
        return await response.json()
    },

    async put(url, body,token) {
        url = `${process.env.VUE_APP_BACKEND_URL}${url}`
        const response = await fetch(url, {
            method: "PUT",
            headers: {
                "Content-type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify(body)
        });
        return await response.json()
    },

    async delete(url, token) {
        url = `${process.env.VUE_APP_BACKEND_URL}${url}`
        const response = await fetch(url, {
            method: "DELETE",
            headers: {
                "Content-type": "application/json",
                "Authorization": `Bearer ${token}`
            },
        });
        return await response.json()
    },
}


