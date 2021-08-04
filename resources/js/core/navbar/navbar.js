import navbarDefaultConfig from "./navbarDefaultConfig";


export default class navbarHorizontal {
    // Will be used by this service for making API calls
    axiosIns = null

    navbarConfig = { ...navbarDefaultConfig}

    constructor(axiosIns) {
        this.axiosIns = axiosIns
    }

    getNaw() {
        return new Promise((resolve, reject) => {
            this.axiosIns.get(navbarDefaultConfig.navbarEndpoint).then(response => {
                this.setNaw(response.data)
                resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    }

    setNaw(data) {
        localStorage.setItem(this.navbarConfig.storageNavbarKeyName, JSON.stringify(data))
    }


    menuList() {
        return JSON.parse(localStorage.getItem(
            this.navbarConfig.storageNavbarKeyName
        ))
    }

}
