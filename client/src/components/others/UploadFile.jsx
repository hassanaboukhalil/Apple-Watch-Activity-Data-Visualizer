import axios from "axios";
import { useState } from "react";

const url = "http://127.0.0.1:8000/api/v1";

const UploadFile = () => {
  const [file, setFile] = useState(null);

  const handleFileChange = (e) => {
    setFile(e.target.files[0]);
  };

  const handleUpload = async () => {
    const formData = new FormData();
    formData.append("file", file);
    formData.append("user_id", localStorage.getItem("id"));

    try {
      const response = await axios.post(url + "/uploadcsv", formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });

      if (response.data.success) {
        console.log("Upload successful");
      } else {
        console.log("something went wrong");
      }
    } catch (err) {
      console.log("Upload failed!");
      console.error(err);
    }
  };

  return (
    <div>
      <input type="file" accept=".csv" onChange={handleFileChange} />
      <button onClick={handleUpload}>Upload</button>
    </div>
  );
};
export default UploadFile;
