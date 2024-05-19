
# Address Book Project

A web address book is a web page that functions to manage contacts, such as adding new contacts, editing contact data, deleting contact data, and being able to view all contact data you have. Not only that, this website has other features such as being able to filter and group based on certain criteria. This makes it easier to manage contacts.


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`DB_CONNECTION`
`DB_HOST`
`DB_PORT`
`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`



## Running App

For the first is running seeder for database with command 
```bash
php artisan db:seed
```

To run tests, run the following command

```bash
npm run dev
```

```bash
php artisan serve 
```


## Demo

Link demo website : 

https://drive.google.com/file/d/16mFOkzaf1Kbkpz7EqCZWPc4Ny8TAoct4/view?usp=drive_link

## Screenshots

![App Screenshot](https://lh3.googleusercontent.com/pw/AP1GczOui0KcTfvkerK4vxdXW1Q5RTaKdZAIvpgidBfj91myleXftDeW_u9Z9rgikPWIynLlcM8PLHREHppN_MMBc1kd6DrbdUDviaDX6eviqokF9zrAG6f0-FlFUwTsLzx76WsPvd4nSS-gVKXUWLnD9h-NRqRDxFQFjAyLrtnIRrUqWYkJKb1be5vSWNPY-Q8a1Pnt9WMD3RiZkdOZZHyC4zWq_GSYrJPCWKK1QnTEbfzCvN1jAsBqpKDW-D8HeydCHbOiugcdskV63_acGW_N1rvJJS8zYwU8CzveLfpYa0IQsjbEwnvo4dGdNQ-w-OlPH0yqly7c_ASmfDA8qwtTtkGmHpBAm6B9q1zSHo0gLWRCHkt86a2Gc1JM-fh94zLlkWbG-PHugbUQy2jNsTM4lTw4mUl8eq7pqP04s_4Nl9_IyBbcYKwPdq2stsdeaP5P138QV4coGLwsj3elM96sya4X8FIZDP2iEoEH4EwM4FYppm1IhZ9Fp2IOSXyBlPuDZ_qfiXcfWIoz9fIrOrl4LvV_aM9YHiC0-g2IlExo0H03wY_2EJ_qT86yso_72n7JimpidROGCLXE7IpZzcaIcHpaUuRwDJy7CfjcEuXMcUY7DThtc8S9gxBceFWUXDktLnPbbEa0ilW3R73fNUQerLbtqN2bayW5E7gN7rWarVRd2rIBltuTDnG45d5OqiJ1_NHmfgBEphB4CS8oUrDHCybrIu9OIpEPdEdG0QVJcYMNZXhxs15-v1t2ncddbdX_qGlMxAk4Qnp7y-f46L32Q-t_041djSEc3P_cvMo5K8xnb9EuVX0xRdxftwPEQ17OaRGXbMgVloLtqhnueg50D1V1JfObXCvgg_f4SWsCvaeO8I1_oSiBMtncvjxeZ33tTJp1d8lrlDTZVEqx8vVfVmY=w1869-h947-s-no-gm?authuser=0)

Create new contact
![App Screeshoot](https://lh3.googleusercontent.com/pw/AP1GczNqfGjs2Gb3XEptTiBrulxBmqnM7ZS-aB8zCbPSuh5f8MFwnVGZ6HEU5Lynu8WEoDk_tD-F_wTosAW0wEO_KLKiCinuYi4UVEIgGDvq_mXzUn9I4EcJ04qIjiPSbWzGXUCb5mkS2WdCQZsUqnBEeT5wOzzCcuI9mp5YTrrcVyHAhr51PJrPIggkJbzuvzwRC23xDdLOUxLbIh9_Ro4dKxiCE9vRgPYtY3n-Avohnfv1gL2Ykk5MGCPg1voRLhF1d0onG5gYv1V-QIuqFkNG7y_lMtYAq40nKWZ226alBrKBS9G1D0u4x6znyWBAPkrCKCgZ0jypPM7TVRv-vmn_zcMADUZhsnECuiA8NcylX3PjUzo6y7LGuaS5ux3IaLd7w4_d4ZD7aE4VrRUWV1woeYY0iyOQtPBSmlFuAx4enK1sjJD6V7ireq4vy4Fo4nm0MQs_SQAMecQl4FFNhTtcnEMHP_VPFwszxmTed45XQ77ENZKhjJ2eyV0gJJUKGV4iCVRqCqCGkx-0R7mBiBtDXuoyMACTXShfQL8MvGCLZ8RCyhfQtotTE0imBFe1QScCdtD5DxS43H8Xmv-BodR-v_S2tNxkIG7oH5-Uy4OrwPnNs9qcVUaBt_iCPQCPH_X32PK6_GWXRcr2Ni3KIKKnrCzUplguImMo0NgDDapx307QKl5CUxHqy_CX5T3kUtDR5hX2dxlvIg2CEx2Bn6ga0fvIdTnNnvMx07qcRVK48ORSxnyJsm-jECmyNLAfeknRZoo-sfyZKENhycx1YqHHzWw9rf47JL2cAhxwMOXWt1ZMBE7hHqKJtb-Z_IPCLS_oUqaA9w1IyVTDIkCK4P_gpDDmyu0EfTsWCGj-BnTEFP3MV8kJLxBiWelAyEm0fzxrXA0QMtMjZac70c4l468AvcI=w1916-h940-s-no-gm?authuser=0)




## Features

- Show all contact
- Created new contact
- Update contact
- Delete contact
- Search
- Filtering


## API Reference

#### Get all contact

```http
  GET /contacts
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get item

```http
  GET /contacts/{id?}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### Add contact

```http
  POST /contacts/store
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. name to fill in the database  |
| `address`      | `string` | **Required**.  address to fill in the database
| `phone`      | `string` | **Required**. phone to fill in the database |
| `Relationship`      | `string` | **Default**. automatically defaults to the Friends option |
| `Gender`      | `string` | **Default**. automatically defaults to the Male option |
| `Status`      | `string` | **Default**. automatically defaults to the Active option |


#### Update contact

```http
  PUT /contacts/update/{id?}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | Required. Id of item to fetch  |
| `name`      | `string` | **Required**. name to fill in the database  |
| `address`      | `string` | **Required**.  address to fill in the database
| `phone`      | `string` | **Required**. phone to fill in the database |
| `Relationship`      | `string` | **Default**. automatically defaults to the Friends option |
| `Gender`      | `string` | **Default**. automatically defaults to the Male option |
| `Status`      | `string` | **Default**. automatically defaults to the Active option |

#### Delete contact

```http
  DELETE /contacts/delete/{id?}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### Search contact

```http
  GET /search
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | query for search |
| `address`      | `string` | query for search |
| `phone`      | `string` | query for search |

#### Filter contact

```http
  GET /filter
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `Relationship`      | `string` | Criteria for filter |
| `Gender`      | `string` | Criteria for filter |
| `Status`      | `string` | Criteria for filter |



## Tech Stack

**Client:** Vue.Js

**Server:** Laravel

**Single Page Aplication**


# Hi, I'm Nilam! 👋


## Authors

- [@Nilam Cahya](https://www.instagram.com/nilamccc/)


## 🔗 Links

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/nilamcahyaa/)


