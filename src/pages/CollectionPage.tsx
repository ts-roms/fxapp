import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { Collections } from '@app/components/apps/collections/Collections';
import { useTranslation } from 'react-i18next';

const CollectionPage: React.FC = () => {
  const { t } = useTranslation();
  return (
    <>
      <PageTitle>{t('common.payments')}</PageTitle>
      <Collections />
    </>
  );
};

export default CollectionPage;
