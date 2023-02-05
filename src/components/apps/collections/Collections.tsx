import React, { useState } from 'react';
import { DownloadOutlined, PlusOutlined } from '@ant-design/icons';
import { CollectionsTable } from '@app/components/tables/Collections/CollectionsTable';
import CollectionModal from '@app/shared/Modal/CollectionModal';
import { Button } from 'antd';
import { useTranslation } from 'react-i18next';
import * as S from './Collections.styles';

export const Collections: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);
  return (
    <S.CollectionWrapper>
      <CollectionModal  open={open} setOpen={setOpen} />
      <S.Card
        id="collections-table"
        title={t('tables.title', { name: 'Payments' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <React.Fragment>
           <Button
              type="ghost"
              icon={<DownloadOutlined />}
              style={{
                marginRight: 10,
              }}
            >
              Bulk Payment
            </Button>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Payment' })}
            </Button>
          </React.Fragment>
        }
      >
        <CollectionsTable />
      </S.Card>
    </S.CollectionWrapper>
  );
};
