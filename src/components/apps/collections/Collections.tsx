import { PlusOutlined } from '@ant-design/icons';
import { CollectionsTable } from '@app/components/tables/Collections/CollectionsTable';
import { Button } from 'antd';
import { useTranslation } from 'react-i18next';
import * as S from './Collections.styles';

export const Collections: React.FC = () => {
  const { t } = useTranslation();

  return (
    <S.CollectionWrapper>
      <S.Card
        id="collections-table"
        title={t('tables.title', { name: 'Payments' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => console.log('Add new transaction')}
            >
              {t('actions.new', { name: 'Payments' })}
            </Button>
          </>
        }
      >
        <CollectionsTable />
      </S.Card>
    </S.CollectionWrapper>
  );
};
