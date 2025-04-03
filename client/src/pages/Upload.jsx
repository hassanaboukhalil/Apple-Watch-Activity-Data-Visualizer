import Header from "../components/layout/Header";

import Section from "../components/layout/Section";
import Main from "../components/layout/Main";
import SectionTitle from "../components/others/SectionTitle";
import UploadFile from "../components/others/UploadFile";

const Upload = () => {
  return (
    <>
      <Header />
      <Main>
        <Section>
          <SectionTitle>Document</SectionTitle>
          <UploadFile />
        </Section>
      </Main>
    </>
  );
};
export default Upload;
