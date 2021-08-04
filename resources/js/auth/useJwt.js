import JwtService from "./jwtService";
import axios from "@axios";


const jwt = new JwtService(axios, {})
export default jwt
