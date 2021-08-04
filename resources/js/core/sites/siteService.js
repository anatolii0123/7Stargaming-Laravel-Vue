import globalConfig from "../globalConfig";

export default class siteService {
    // Will be used by this service for making API calls
    axiosIns = null
    constructor(axiosIns) {
        this.axiosIns = axiosIns
        this.setAxiosHeaderAddActiveSite()
    }

    getSites() {
        return new Promise(resolve => {
            this.axiosIns.get(globalConfig.mySitesEndpoint).then(response => {
                this.setSites(response.data)
                if (response.data && response.data.list.length > 0) this.setActiveSite(response.data.list[0].id)
                resolve(response)
            })
        })
    }

    setSites(data) {
        localStorage.setItem(globalConfig.storageMySitesKeyName, JSON.stringify(data))
    }

    getActiveSite() {
        return localStorage.getItem(globalConfig.storageActiveSiteKeyName)
    }

    setActiveSite(data) {
        localStorage.setItem(globalConfig.storageActiveSiteKeyName, data)
    }

    setAxiosHeaderAddActiveSite() {
        this.axiosIns.interceptors.request.use(
            config => {
                const activeSite = this.getActiveSite()

                if (activeSite){
                    config.headers.ActiveSite = activeSite
                }else{
                    config.headers.ActiveSite = null
                }

                return config
            },
            error => Promise.reject(error),
        )
    }

}
